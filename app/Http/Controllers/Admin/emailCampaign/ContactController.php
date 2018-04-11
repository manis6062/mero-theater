<?php

namespace App\Http\Controllers\Admin\emailCampaign;

use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Library\AjaxResponse;
use App\EmailContact;
use App\EmailGroup;
use App\EmailContactGroup;
use App\Http\Requests\ContactImport;
use Illuminate\Support\Facades\Input;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $userId;

    public function __construct()
    {

    }
    public function index()
    {
        // Checking if session exist. Inserted contact id from xlsx file
        $contacts = [];
        if (Session::has('insertedIds')) {

            $contactIds = json_decode(Session::get('insertedIds'));
            $contacts = EmailContact::whereIn('id', $contactIds)->get();
            Session::forget('insertedIds');
        }
        //
        $groups = EmailGroup::where('admin_id', Auth::guard('admin')->user()->id)->get();
        $contact = EmailContact::where('admin_id', Auth::guard('admin')->user()->id)->paginate(20);

        return view('admin.email-marketing.contacts.index')->with(['items' => $contact,'contacts' => $contacts, 'groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Get the groups
      $groups = EmailGroup::where('admin_id', Auth::guard('admin')->user()->id)->select('name', 'id')->get();
      return view('admin.email-marketing.contacts.create', ['groups' => $groups]);
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required | unique:emailcontacts_tbl',
            'group' => 'required'
        ]);
        $id=\Auth::guard('admin')->id();
        $data = array(
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'admin_id'=>$id
        ); 
        $contactId=$request->email;     
        EmailContact::create($data);
        $emailcontact_id =EmailContact::where('email',$contactId)->first()->id;
        $emailgroup_id=$request->group;
        // Insert group
        if ($request->has('group')) {
            $emailcontact =EmailContact::find($emailcontact_id);
            $emailcontact->groups()->attach($emailgroup_id);
        }
        Session::flash('success',"Contact successfully added");
        return redirect('admin/email-marketing/emailcontact')->with('message','Update successfull.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = EmailContact::find($id);
        return view('admin.email-marketing.Group.edit')->with(['item' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $sqlForSelected = "
        SELECT `emailcontacts_tbl`.*, `emailgroup_tbl`.name FROM `emailgroup_tbl` LEFT JOIN `emailcontact_emailgroup_tbl` ON `emailcontact_emailgroup_tbl`.`emailgroup_id` = `emailgroup_tbl`.`id` LEFT JOIN `emailcontacts_tbl` ON `emailcontact_emailgroup_tbl`.`emailcontact_id` = `emailcontacts_tbl`.`id` WHERE (`emailcontacts_tbl`.id=$id)
        ";

        $emailcontact = \DB::select(\DB::raw($sqlForSelected));

        $sqlForNotSelected = "
        SELECT `emailgroup_tbl`.`id`, `emailgroup_tbl`.`name`
        FROM `emailgroup_tbl`
        ";
        $groups = \DB::select(\DB::raw($sqlForNotSelected));
        //  $contact = EmailContact::find($id);
        return view('admin.email-marketing.contacts.edit')->with(['item'=> $emailcontact,'groups'=>$groups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $existingemail = EmailContact::find($id)->email;

        $newemail=$request->email;
        if($existingemail == $newemail){
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'group' => 'required'
            ]);
        }elseif ($existingemail !=$newemail){
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required | unique:emailcontacts_tbl',
                'group' => 'required'
            ]);
        }
        $data=array(
           'first_name'=>$request->first_name,
           'last_name'=>$request->last_name,
           'email'=>$request->email,
       );

        try {
         $gid=$request->group;
         $new=EmailContact::find($id)->update($data);
         EmailContact::find($id)->groups()->sync($gid);
         return redirect('admin/email-marketing/emailcontact');
     } catch (ModelNotFoundException $ex) {
        Session::flash('warning', "oops ! Something went wrong");
        return redirect()->back();
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emailcontact = EmailContact::find($id);
        $emailcontact->groups()->detach($id);
        $contact = EmailContact::find($id)->delete();
        if(isset($contact)){
            return 'true';
        }

        return 'false';
        return redirect()->back();
    }

    // Mass contact delete
    public function postMassDelete(Request $request )
    {
        $ids = $request->all();
        foreach ($ids['contacts'] as $id) {
            if($id != 'on'){
                $emailcontact = EmailContact::find($id);
                $emailcontact->groups()->detach($id);
                EmailContact::find($id)->delete();
            }

        }
        return 'true';
    }

    public function importExcel(Request $request)
    {
      $this->validate($request,[
          'contacts_file'=> 'required',
          'group'=>'required',
      ]);

      if(Input::hasFile('contacts_file')){
          $path = Input::file('contacts_file')->getRealPath();
          $data = Excel::load($path, function($reader){ })->get();
          $dataToImport = [];
          $count = 0;
          foreach ($data as $value) {
              if($value->getTitle() == 'Sheet1')
              {
                foreach ($value as $val) {
                    $dataToImport[] = $val->toArray();
                }
            }

            if($value->getTitle() == null)
            {
                foreach ($data as $value) {
                    $count++;
                    if($count <= $data->count())
                    {
                        $dataToImport[] = $value->toArray();
                    }else{
                        break;
                    }

                }
            }
        }
        $emailValidationData = [];
        if($dataToImport != null){
            foreach ($dataToImport as $values) {
                if(isset($values['first_name']) && isset($values['email']) && isset($values['last_name']))
                {
                    if(EmailContact::where('email', $values['email'])->first() == null )
                        {
                            $insert['first_name'] = $values['first_name'];
                            $insert['email'] = $values['email'];
                            $insert['last_name'] = $values['last_name'];
                            $insert['admin_id']= \Auth::guard('admin')->id();
                            if(filter_var($insert['email'],FILTER_VALIDATE_EMAIL)){
                               $emailgroup_id=$request->group;
                               if ($request->has('group')) {
                                $result = EmailContact::create($insert);
                                $emailcontact_id =EmailContact::where('email',$insert['email'])->first()->id;
                                $emailcontact =EmailContact::find($emailcontact_id);
                                $emailcontact->groups()->attach($emailgroup_id);
                            }

                        } else{
                            return redirect('admin/email-marketing/emailcontact/create')->with('invalidEmailData', 'The excel file contain invalid email');
                        }
                    }else{
                        $emailValidationData[] = $values['email'];
                    }  
                }else{
                    return redirect('admin/email-marketing/emailcontact/create')->with('empty', 'Some of the fields are empty');
                }
            }
        }
        if(count($emailValidationData) > 0)
        {
            return redirect('admin/email-marketing/emailcontact/create')->with('emailErrorData', $emailValidationData)->with('emailErrorData', $emailValidationData);
        }
        if(count($emailValidationData) == 0)
        {
            return redirect('admin/email-marketing/emailcontact')->with('message','Contact have been successfully imported.');
        }
    }else{

    }

}
}

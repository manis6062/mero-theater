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

    /**
     * Import contact details
     */

    

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
// if(isset($result)){
//     dd('Insert Record successfully.');
// }
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
//return redirect::back()->withErrors(['msg', $rem]);
//return back()->with($rem);

    }else{

    }

}

public static function ComposeContactImport($excelFile = '')
{

    $insertedIds = [];
    \Excel::load(public_path($excelFile), function ($reader) use ($excelFile, &$insertedIds) {

        $contacts = $reader->all();
        $contacts->toArray();


            // Formating the contacts
        foreach ($contacts as $contact) {
            $insertedIds[] = $contact['phone'];

        }

            //Delete the file
        if (\File::exists(public_path($excelFile))) {
            \File::delete(public_path($excelFile));
        }


    });
    return $insertedIds;
}

public static function csvToArray($filename, $delimiter = ",")
{
        /*if (!file_exists(public_path($filename)) || !is_readable($filename))
        return false;*/

        $header = null;
        $data = array();
        if (($handle = fopen(public_path($filename), 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
                $data[] = preg_replace("/&#?[a-z0-9]+;/i", "", $row);
            }
            fclose($handle);
        }
        //Delete the file
        if (\File::exists(public_path($filename))) {
            \File::delete(public_path($filename));
        }

        return $data;
    }




    /**
     * Import contact details
     */
    public function import(ContactImport $request, $xlsx)
    {

        //$excelFile = '/uploads/import/contacts_1466741430-18.xlsx';
       $excelFile = $request->getFile(Auth::guard('admin')->user()->id);

       \Excel::load(public_path($excelFile), function ($reader) use ($request) {
         $contacts = $reader->all();
         $contacts->toArray();

            // Formating the contacts
         foreach ($contacts as $contact) {
            $formatedContacts = [
                'admin_id' => Auth::guard('admin')->user()->id,
                'first_name' => isset($contact['first_name']) ? $contact['first_name'] : "",
                'last_name' => isset($contact['last_name']) ? $contact['last_name'] : "",
                'country_code' => '+977',
                'phone' => $contact['phone'],
                'created_at' => Carbon::now(),
            ];
                // Inserting contact in database
            $insertedId = Contact::insertGetId($formatedContacts);


                // Insert group
            if ($request->group_id !=null) {
                ContactGroup::create([
                    'group_id' => $request->input('group_id'),
                    'contact_id' => $insertedId
                ]);
            }
        }
        Session::flash('success', "Successfully added contacts");
    });

        //Delete the file
       if (\File::exists(public_path($excelFile))) {
        \File::delete(public_path($excelFile));
    }
    return redirect('admin/email-marketing/contact');
}

    /**
     * Add contacts to group
     */
    public function postAddContactsToGroup(Request $request)
    {
        $input = $request->all();
        $groupId = trim($input['groupId']);
        $contactsId = $input['contactsId'];
        $groupsData = [];
        foreach ($contactsId as $id) {
            $groupsData[] = [
                'group_id' => $groupId,
                'contact_id' => $id,
            ];
        }
        if (ContactGroup::insert($groupsData)) {
            return AjaxResponse::sendResponse("Successfully assign contacts to group", false, 200);
        }
        return AjaxResponse::sendResponse('Error! problem occured');
    }

    /**
     * Delete contact from group
     */
    public function deleteContactFromGroup(Request $request)
    {
        $input = $request->all();
        $contactGroupId = trim($input['contactGroupId']);
        $contactGroup = ContactGroup::find($contactGroupId);
        if ($contactGroup) {
            $contactGroup->delete();
            return AjaxResponse::sendResponse("Successfully removed contact from group", false, 200);
        }
        return AjaxResponse::sendResponse('Error! problem occured');
    }

    /**
     * Add contacts to group
     */
    public function addContactToGroup(Request $request)
    {
        $input = $request->all();
        $groupId = trim($input['groupId']);
        $contactId = trim($input['contactId']);

        $groupData = [
            'group_id' => $groupId,
            'contact_id' => $contactId,
        ];
        if (ContactGroup::insert($groupData)) {
            return AjaxResponse::sendResponse("Successfully assign contact to group", false, 200);
        }
        return AjaxResponse::sendResponse('Error! problem occured');
    }
}

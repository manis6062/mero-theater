<?php

namespace App\Http\Controllers\Admin\emailCampaign;

use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Carbon\Carbon;

use App\Library\AjaxResponse;

use App\EmailContact;
use App\EmailGroup;
use App\EmailContactGroup;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\ContactImport;


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
        return redirect('admin/box-office/email-marketing/emailcontact');
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
       
        // $admin_id=Auth::guard('admin')->user()->id;
        //$groups = EmailGroup::where('admin_id', Auth::guard('admin')->user()->id)->get();

        $sqlForSelected = "
           SELECT `emailcontacts_tbl`.*, `emailgroup_tbl`.* FROM `emailgroup_tbl` LEFT JOIN `emailcontact_emailgroup_tbl` ON `emailcontact_emailgroup_tbl`.`emailgroup_id` = `emailgroup_tbl`.`id` LEFT JOIN `emailcontacts_tbl` ON `emailcontact_emailgroup_tbl`.`emailcontact_id` = `emailcontacts_tbl`.`id` WHERE (`emailcontacts_tbl`.id=$id)
        ";
       
        $emailcontact = \DB::select(\DB::raw($sqlForSelected));
        $sqlForNotSelected = "
            SELECT `emailgroup_tbl`.`id`, `emailgroup_tbl`.`name`
            FROM `emailgroup_tbl`
        ";
        $groups = \DB::select(\DB::raw($sqlForNotSelected));
        dd($emailcontact);

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
    public function update(ContactRequest $request, $id)
    {
         $input = $request->all();
        try {
            EmailContact::where('id', $id)
                ->where('admin_id', Auth::guard('admin')->user()->id)
                ->update([
                    'first_name' => $input['first_name'],
                    'last_name' => $input['last_name'],
                    'phone' => $input['phone'],
                ]);
            Session::flash('success', "Contact Successfully Updated");
            return redirect('admin/box-office/email-marketing/contact');
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

        try {
            $contact = Contact::where('admin_id', Auth::guard('admin')->user()->id)->findOrFail($id);
            $contact->delete();
            $contact_grp=ContactGroup::where('contact_id',$id)->first();
            $contact_grp->delete();
            Session::flash('success', 'Successfully deleted contact');
        } catch (ModelNotFoundException $e) {

        }
        return redirect()->back();
    }

    // Mass contact delete
    public function postMassDelete(Request $request )
    {
        $inputs = $request->all();

        $deletedData = \DB::table('contacts')->whereIn('id', $inputs['contacts'])->where('admin_id',Auth::guard('admin')->user()->id)->delete();

        return response()->json($deletedData, 200);
    }

    /**
     * Import contact details
     */
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
        return redirect('admin/box-office/email-marketing/contact');
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

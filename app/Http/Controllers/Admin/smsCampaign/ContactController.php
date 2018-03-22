<?php

namespace App\Http\Controllers\Admin\smsCampaign;

use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Carbon\Carbon;

use App\Library\AjaxResponse;

use App\Models\Contact;
use App\Models\Group;
use App\Models\ContactGroup;
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
            $contacts = Contact::whereIn('id', $contactIds)->get();
            Session::forget('insertedIds');
        }
        //
           $groups = Group::where('admin_id', Auth::guard('admin')->user()->id)->get();
          $contact = Contact::where('admin_id', Auth::guard('admin')->user()->id)->paginate(20);

        return view('admin.smsCampaign.contacts.index')->with(['items' => $contact, 'contacts' => $contacts, 'groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Get the groups
          $groups = Group::where('admin_id', Auth::guard('admin')->user()->id)->select('name', 'id')->get();
        return view('admin.smsCampaign.contacts.create', ['groups' => $groups]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        // Get all inputs
             $input = $request->all();

            $contactId = Contact::insertGetId([
            'admin_id' => Auth::guard('admin')->user()->id,
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'phone' => $input['phone'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        // Insert group
        if ($request->has('group_id')) {
            ContactGroup::create([
                'group_id' => $input['group_id'],
                'contact_id' => $contactId
            ]);
        }
        Session::flash('success',"Contact successfully added");
        return redirect('admin/box-office/smsCampaigns/contact');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $contact = Contact::find($id);
        return view('users.contacts.view')->with(['item' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $admin_id=Auth::guard('admin')->user()->id;
        $groups = Group::where('admin_id', Auth::guard('admin')->user()->id)->get();

        $sqlForSelected = "
            select groups.name, contact_group.id as contact_group_id
            from groups
            inner join contact_group on groups.id = contact_group.group_id
            where groups.admin_id = $admin_id
            and contact_group.contact_id = $id
        ";
        $selectedGroups = \DB::select(\DB::raw($sqlForSelected));

        $sqlForNotSelected = "
            select groups.name, groups.id
            from groups
            where groups.id not in (select group_id from contact_group where contact_group.contact_id = $id)
            and groups.admin_id = $admin_id
        ";
        $notSelectedGroups = \DB::select(\DB::raw($sqlForNotSelected));

         $contact = Contact::find($id);
        return view('admin.smsCampaign.contacts.edit')->with(['item' => $contact, 'groups' => $groups, 'selectedGroups' => $selectedGroups, 'notSelectedGroups' => $notSelectedGroups, 'contactId' => $id]);
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
            Contact::where('id', $id)
                ->where('admin_id', Auth::guard('admin')->user()->id)
                ->update([
                    'first_name' => $input['first_name'],
                    'last_name' => $input['last_name'],
                    'phone' => $input['phone'],
                ]);
            Session::flash('success', "Contact Successfully Updated");
            return redirect('admin/box-office/smsCampaigns/contact');
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
        return redirect('admin/box-office/smsCampaigns/contact');
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

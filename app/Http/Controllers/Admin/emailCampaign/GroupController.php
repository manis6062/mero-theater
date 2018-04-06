<?php

namespace App\Http\Controllers\Admin\emailCampaign;

use App\EmailContact;
use App\EmailContactGroup;
use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Auth;
use Validator;

use App\EmailGroup;

class GroupController extends Controller
{
    private $loginUserId;
    private $contactRepo;

    public function __construct(ContactRepository $contactRepo)
    {

        $this->contactRepo = $contactRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $group = EmailGroup::where('admin_id', Auth::guard('admin')->user()->id)->paginate(20);
        return view('admin.email-marketing.Group.index')->with(['items' => $group]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.email-marketing.Group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['admin_id'] =    Auth::guard('admin')->user()->id;


        $validator = Validator::make($input, [
            'name' => "required|unique:emailgroup_tbl,name,NULL,id,admin_id,".Auth::guard('admin')->user()->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $a=EmailGroup::create($input);
        Session::flash('success', config('constant.SUCCESS_CREATE'));
        return redirect('admin/email-marketing/emailgroup');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = EmailGroup::find($id)->id;
        $contactIds = EmailContactGroup::where('emailgroup_id', $id)->pluck('emailcontact_id');
        $filteredcontact=EmailContact::whereNotIn('id',$contactIds)->get();
        $contactEmail = collect();
        foreach ($contactIds as $contactId) {
            $contactEmail->push(EmailContact::find($contactId));
        }
         return view('admin.email-marketing.Group.view')->with(['items'=>$contactEmail,'otherContacts'=>$filteredcontact,'groupId'=>$group]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $group = EmailGroup::where('admin_id',Auth::guard('admin')->user()->id)->findOrFail($id);
            return view('admin.email-marketing.Group.edit')->with(['item' => $group]);
        } catch (ModelNotFoundException $ex) {
            abort(404);
        }
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
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => "required|unique:emailgroup_tbl,name," . $id . ",id,admin_id,".Auth::guard('admin')->user()->id,
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        try {
            EmailGroup::where('id', $id)
                ->where('admin_id',Auth::guard('admin')->user()->id)
                ->update([
                    'name' => $input['name'],
                ]);
            Session::flash('success', "Group Successfully Updated");
            return redirect('admin/email-marketing/emailgroup');
        } catch (ModelNotFoundException $ex) {
            Session::flash('warning', "Oops Something Went wrong");
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
             $group = EmailGroup::where('admin_id',Auth::guard('admin')->user()->id)->findOrFail($id);
            $group->delete();
            Session::flash('success', "Deleted Successfully");
        } catch (ModelNotFoundException $e) {
            Session::flash('warning', "Oops Something Went Wrong");
        }
        return redirect()->back();
    }

    // Mass group delete
    public function postMassDelete(Request $request )
    {
        $inputs = $request->all();
        $deletedData = \DB::table('emailgroup_tbl')->whereIn('id', $inputs['contacts'])->where('admin_id',Auth::guard('admin')->user()->id)->delete();
        return response()->json($deletedData, 200);
    }

    public function postAddContactsToGroup(Request $request)
    {
        $emailgroup_id=$request->group_id;
        $emailcontact_ids=$request->otherContact;
        if ($request->has('otherContact')) {
             foreach ($emailcontact_ids as $emailcontact_id) {
                 $EmailContact = EmailContact::find($emailcontact_id)->groups()->attach($emailgroup_id);
             }
            Session::flash('success', "Contacts added to group");
        } else {
            Session::flash('error', "Sorry! Error occured");
        }

        return redirect()->back();
    }

    public function postDeleteContactsFromGroup(Request $request)
    {
        $inputs = $request->all();

        $groupContact = ContactGroup::where('contact_id', $inputs['contact_id'])->where('group_id', $inputs['group_id'])->first();
        if ($groupContact) {
            if ($groupContact->delete()) {
                Session::flash('success', "Contacts deleted from group");
            } else {
                Session::flash('error', "Sorry! Error occured");
            }
        }

        echo 1;
    }
}

<?php

namespace App\Http\Controllers\Admin\smsCampaign\sms;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests;


use App\Repositories\ComposeRepository;
use App\Models\Contact;
use App\Models\Group;
use App\Models\MessageTemplate;
use App\Models\SmsSetting;
use Carbon\Carbon;


class CampaignController extends Controller
{
    protected $compose;

    protected $userId;

    /**
     * Constructor to load repository
     */
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {





        $contactsArray = [];
        $contacts = Contact::where('admin_id',Auth::guard('admin')->user()->id)->get();
        foreach ($contacts as $contact) {
            $contactsArray[] = [
                'id' => $contact->id,
                'name' => $contact->full_name . "(" . $contact->phone . ")"
            ];
        }
        $searchingValue = array_merge($contactsArray);




        $sms_setting = [
            "sms_length"=>160,
            "unicode_sms_length"=>70,
            "sms_cost"=>1.5,
            "taglib_name"=>":via AakashSMS.com",
            "taglib_sms_cost"=>1.2,
            "purpose"=>"web",
        ];



         $contactGroup=Group::where('admin_id',Auth::guard('admin')->user()->id)->pluck('name','id');


        return view('admin.smsCampaign.campaign.index', ['contacts'=> $searchingValue, 'sms_setting' => $sms_setting, 'contactGroup' => $contactGroup]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $contactsArray = [];
        $contacts = Contact::where('user_id', $this->userId)->get();
        foreach ($contacts as $contact) {
            $contactsArray[] = [
                'id' => $contact->id,
                'name' => $contact->full_name . "(" . $contact->phone . ")"
            ];
        }

        $groupsArray = [];
        $groups = Group::where('user_id', $this->userId)->get();
        foreach ($groups as $group) {
            $groupsArray[] = [
                'id' => $group->id,
                'name' => $group->name . "(" . $group->countContact() . ")"
            ];
        }

        $searchingValue = array_merge($contactsArray, $groupsArray);
        $templates = MessageTemplate::where('user_id', $this->userId)->get();

        return view('users.compose.create')->with('contacts', $searchingValue)->with('templates', $templates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

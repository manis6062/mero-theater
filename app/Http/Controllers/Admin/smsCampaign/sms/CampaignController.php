<?php

namespace App\Http\Controllers\Admin\smsCampaign\sms;


use App\Jobs\SendSmsQueue;
use App\Library\AjaxResponse;
use App\Library\FilterRecipient;
use App\Models\Message;
use App\Models\MessageHistory;
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
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Exception\GuzzleException;


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
        $contacts = Contact::where('admin_id',Auth::guard('admin')->user()->id)->get();
        foreach ($contacts as $contact) {
            $contactsArray[] = [
                'id' => $contact->id,
                'name' => $contact->full_name . "(" . $contact->phone . ")"
            ];
        }

        $groupsArray = [];
        $groups = Group::where('admin_id',Auth::guard('admin')->user()->id)->get();
        foreach ($groups as $group) {
            $groupsArray[] = [
                'id' => $group->id,
                'name' => $group->name . "(" . $group->countContact() . ")"
            ];
        }

        $searchingValue = array_merge($contactsArray, $groupsArray);
        $templates = MessageTemplate::where('admin_id',Auth::guard('admin')->user()->id)->get();

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


    public function getContactAndGroupForAutocomplete(Request $request)
    {
        $input = $request->all();


        $contactsArray = [];
        $contacts = Contact::where('admin_id',Auth::guard('admin')->user()->id)
            ->where(function ($query) use ($input) {
                if (isset($input['query'])) {
                    $query->orWhere('first_name', 'like', '%' . $input['query'] . '%');
                    $query->orWhere('last_name', 'like', '%' . $input['query'] . '%');
                    $query->orWhere('phone', 'like', '%' . $input['query'] . '%');
                }
            })
            ->get();

        foreach ($contacts as $contact) {
            $contactsArray[] = [
                'display' => $contact->phone,
                'tuple' => [
                    'id' => $contact->id,
                    'type' => "contact",
                    'display' => $contact->phone,
                ],

            ];
        }

        $groupsArray = [];
        /*$groups = Group::where('user_id', $this->userId)
            ->where(function ($querya) use ($input) {
                if (isset($input['query'])) {
                    $querya->where('name', 'like', '%' . $input['query'] . '%');
                }
            })
            ->get();
        foreach ($groups as $group) {
            $groupsArray[] = [
                'display' => $group->name . " (" . $group->countContact() . ")",
                'tuple' => [
                    'id' => $group->id,
                    'type' => "group",
                    'display' => $group->name . " (" . $group->countContact() . ")",
                ],
            ];

        }*/

        $searchingValue = array_merge($contactsArray, $groupsArray);
        return AjaxResponse::sendResponse($searchingValue, false, 200);
    }


    public function saveMessageTemplate(Request $request)
    {
        $input = $request->all();

        $messageTemplate = [
            'admin_id' => Auth::guard('admin')->user()->id,
            'name' => $input['name'],
            'body' => $input['message'],
            'taglib' => $input['tagline'],
        ];

        MessageTemplate::create($messageTemplate);

        return AjaxResponse::sendResponse('Template added Successfully', false, 200);
    }

    public function getMessageTemplates(Request $request)
    {
        $templatesArray = [];
        $templates = MessageTemplate::where('admin_id',Auth::guard('admin')->user()->id)->get();
        foreach ($templates as $template) {
            $templatesArray[] = [
                'id' => $template->id,
                'name' => $template->name,
                'body' => $template->body,
                //'tagline' => $template->tagline,
            ];
        }

        return AjaxResponse::sendResponse($templatesArray, false, 200);
    }


    public function downloadSample($sampleyType){
        if ($sampleyType) {
            switch ($sampleyType) {
                case 'sample1':
                    $filename = public_path('/uploads/import/compose-contacts-1.csv');
                    return response()->download($filename);
                    break;
                case 'sample2':
                    $filename = public_path('/uploads/import/compose-contacts.csv');
                    return response()->download($filename);
                    break;
                case 'sample3':
                    $filename = public_path('/uploads/import/contacts-sample.xls');
                    return response()->download($filename);
                    break;
                case 'sample4':
                    $filename = public_path('/uploads/import/contacts.xlsx');
                    return response()->download($filename);
                    break;
                default:
                    return redirect()->back();
            }
        }
        return redirect()->back();
    }

    public function sendSMS(Request $request,FilterRecipient $filterRecipient)
    {
        $input = $request->all();
        // Log::info("new log data " .$input);


        /* Ajax validation response if error on request */
        if ($request->ajax()) {
            $v = \Validator::make($input, [
                //'contacts' => 'file|mimes:csv',
                'date' => 'required_with:time',
                'time' => 'required_with:date',
                'body' => 'required',
                'recipients' => 'required_without:contacts|json|not_in:[],""'],
                [
                    'body' => 'The message field is required',
                    'recipients.*.required' => 'The recipient field is required'
                ]);
            if ($v->fails()) {
                return AjaxResponse::sendResponse($v->errors(), true, 200);
            }
        }

        /****/


        /** Parse recipients **/
        $arr = [];
        $phone = [];
        $group = [];
        $contacts = [];
        $recipients = (json_decode($input['recipients']));
        if (!is_null($recipients)) {
            foreach (json_decode($input['recipients']) as $value) {
                switch ($value->type) {
                    case 'group':
                        $g = Group::where('admin_id', Auth::guard('admin')->user()->id)->where('id', '=', $value->id)->first();
                        if ($g) {
                            $group[] = $g->id;
                        }
                        break;
                    case 'contact':
                        $g = Contact::where('admin_id', Auth::guard('admin')->user()->id)->where('id', '=', $value->id)->first();
                        if ($g) {
                            $contacts[] = $g->id;
                        }
                        break;
                    default:
                        $phone[] = $value->id;
                        break;
                }
            }
        }


        /* Import XLX if exists */
        if (Input::file('contacts')) {


            $imageName = 'contacts_compose_' . time() . '.' . Input::file('contacts')->getClientOriginalExtension();;
            $path = '/public/uploads/import/';
            $returnPath = "/uploads/import/";
            Input::file('contacts')->move(base_path() . $path, $imageName);
            $filename = $returnPath . $imageName;
            $phones = $this->csvToArray($filename);
            //  Log::info("CSV to array " . json_encode($phones));
            if ($phones) {
                $phone_check = array();

                foreach ($phones as $key => $p) {
                    if (isset($p[0])) {
                        $phone_number = isset($p[2]) ? $p[2] : $p[0];
                        if (is_numeric($phone_number)) {
                            $chk = Contact::where('admin_id', Auth::guard('admin')->user()->id)->where('phone', $phone_number)->count();
                            if (!$chk) {
                                Contact::create(array(
                                        'admin_id' => Auth::guard('admin')->user()->id,
                                        'first_name' => isset($p[2]) ? $p[0] : '',
                                        'last_name' => isset($p[1]) ? $p[1] : '',
                                        'country_code' => '+977',
                                        'phone' => $phone_number,
                                    )
                                );
                            }
                            $phone_check[] = $phone_number;

                        } else {
                            return AjaxResponse::sendResponse(['error' => ['Invalid CSV format']], true, 200);
                        }
                    }
//                    else{
//                        return AjaxResponse::sendResponse(['error' => ['Invalid CSV format']], true, 200);
//                    }
                }
                $contact_id = Contact::whereIn('phone', $phone_check)->pluck('id');
                $contacts = $contact_id;
            }
        }
        //use array push
        //Log::info("Phones processed data " . json_encode($phone));

        //   $phone_check=array_filter($phone_check, function($value) { return $value !== ""; });


        $arr['groups'] = $group;
        $arr['contacts'] = $contacts;
        $arr['phone'] = $phone;
        // Inserting phones ie unadded contact in contacts
        $phone_check = array_filter($phone, function ($value) {
            return $value !== "";
        });

        foreach ($phone as $p) {
            $chk = Contact::where('admin_id', Auth::guard('admin')->user()->id)->where('phone', $p)->count();
            if (!$chk) {
                Contact::insertGetId([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'first_name' => "",
                    'last_name' => "",
                    'phone' => $p,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }

        }
        // end


        $smsData = [
            'admin_id' =>Auth::guard('admin')->user()->id,
            'body' => $input['body'],
            'recipients' => json_encode($arr)
        ];
        $schedule_for = 'pending';
        $smsData['schedule_for']=date('Y-m-d H:i:s');
        /** Scheduling time input*/
        if ($input['date'] && $input['time']) {
            $smsData['schedule_for'] = date('Y-m-d', strtotime($input['date'])) . ' ' . date('H:i', strtotime($input['time']));
            $schedule_for = 'pending';
        }




        /**  */
        if ($message = Message::create($smsData)) {

            /** Parse Numbers & make array to put on queue*/
          $recipients = json_decode($message->recipients);
//        $recepientsValue = json_encode($arr);
//        /** Parse Numbers & make array to put on queue*/
//        $recipients = json_decode($recepientsValue);

            $invalidNumbers = [];
            $all_numbers = [];
            $first_name = [];
            $last_name = [];
            $valid_count = 0;
            $invalid_count = 0;
            $fn = [];
            $sn = [];
            $isset_fn = false;
            $isset_sn = false;

            //set array of mobile no, first name and last name of all contact of respective group
            foreach ($recipients->groups as $value) {
                $group = Group::where('id', $value)->with(['contacts'])->first();
                $groupContacts = $group->contacts;
                foreach ($groupContacts as $groupContact) {
                    $all_numbers[] = $groupContact->phone;
                    $first_name[] = $groupContact->first_name;
                    $last_name[] = $groupContact->last_name;
                }
            }

            if (Input::has('group')) {
                foreach ($input['group'] as $value) {
                    $group = Group::where('id', $value)->with(['contacts'])->first();
                    $groupContacts = $group->contacts;
                    foreach ($groupContacts as $groupContact) {
                        $all_numbers[] = $groupContact->phone;
                        $first_name[] = $groupContact->first_name;
                        $last_name[] = $groupContact->last_name;
                    }
                }
            }

            //set array of mobile no, first name and last name of all contact list
            foreach ($recipients->contacts as $value) {
                $individualContact = Contact::where('id', '=', $value)->first();

                $all_numbers[] = $individualContact->phone;
                $first_name[] = $individualContact->first_name;
                $last_name[] = $individualContact->last_name;
            }

            //set valid and invalid no count and push valid no. to array list $all_numbers

            foreach ($recipients->phone as $value) {
                if ($value) {
                    $number = $filterRecipient->checkNetwork($value);
                    if ($number['valid']) {
                        $all_numbers[] = $value;
                        $first_name[] = '';
                        $last_name[] = '';
                    } else {
                        $invalidNumbers[] = $value;
                        $invalid_count++;
                    }
                }

            }

            //check if user has credit
            $available_credit = $this->checkCredit();
            $required_credit = count($all_numbers) * $filterRecipient->countMessageLength($message->body);
            //check if user has sufficient credit
            if ($available_credit < $required_credit) {
                $message->update(['status' => 'aborted', 'status_code' => '4010']);
                return AjaxResponse::sendResponse(['error' => ['Insufficient Credit']], true, 200);
            }


            //Send sms for each valid number
            for ($i = 0; $i < count($all_numbers); $i++) {

                $valid_count++;
                $body = $input['body'];

                //replace {fn##} with first name of specified length
                if ($isset_fn) {
                    foreach ($fn as $key => $value) {
                        $name = substr($first_name[$i], 0, $value);
                        $body = str_replace($key, $name, $body);
                    }
                }

                //replace {sn##} with surname name of specified length
                if ($isset_sn) {
                    foreach ($sn as $key => $value) {
                        $name = substr($last_name[$i], 0, $value);
                        $body = str_replace($key, $name, $body);
                    }
                }

                $number = $filterRecipient->checkNetwork($all_numbers[$i]);


                //     save message to MessageHstory
                MessageHistory::create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'message_id' => $message->id,
                    'status' => 'delivered',
                    'body' => $body,
                    'recipient' => str_replace(' ', '', $all_numbers[$i]),
                    'network' => $number['network'],

                ]);
            }
//            $smsNumber = implode(',', $all_numbers);
            $messegeBody = $input['body'];


            $message_history=MessageHistory::where('message_id',$message->id)->pluck('id')->toArray();
                $chunks = array_chunk($message_history, 300, true);
                $delayValue=2;
                for($i=0; $i<count($chunks);$i++){
                    $job = (new SendSmsQueue($chunks[$i],$messegeBody))->delay(Carbon::parse($message->schedule_for)->addSeconds($delayValue));
                    $this->dispatch($job);
                    $delayValue+=75;
                }

                return AjaxResponse::sendResponse('Message Queued! Valid: ' . $valid_count . ' Invalid: ' . $invalid_count, false, 200);

//            else{
//                try {
//                    $client = new \GuzzleHttp\Client();
//                    $output = $client->post(
//                        'http://aakashsms.com/admin/public/sms/v1/send',
//                        array(
//                            'form_params' => array(
//                                'from' => '31001',
//                                'to' => $smsNumber,
//                                'auth_token' => $this->tokenValue(),
//                                'text' => $messegeBody
//                            )
//                        )
//                    )->getBody();
//                    $obj = json_decode($output);
//                    MessageHistory::whereIn("message_id", [$message->id])->update([
//                        'status' => 'delivered',
//                    ]);
//
//                    return AjaxResponse::sendResponse($obj->response, false, 200);
//                } catch (GuzzleException $exception) {
//                    $responseBody = $exception->getResponse()->getBody(true);
//                    $obj = json_decode($responseBody);
//                    MessageHistory::whereIn("message_id", [$message->id])->update([
//                        'status' => 'failed',
//                    ]);
//                    return AjaxResponse::sendResponse(['error' => [$obj->response]], true, 200);
//
//                }
//            }

        }

        else {
                return AjaxResponse::sendResponse(['error' => ['Something went wrong']], true, 200);
            }


    }


    private function csvToArray($filename, $delimiter = ",")
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

    public function tokenValue(){

        return 'e4bba6043c52ec53a8c7e4f2b2da1e87419e011c17e775fe82e18ffe5f14e4de';
    }


    public function messageHistory(){
        $filterData = (isset($_GET)) ? $_GET : "";
        $message_ids = Message::where('admin_id',Auth::guard('admin')->user()->id)->pluck('id')->toArray();

        $messageHistory = MessageHistory::whereIn('message_id', $message_ids)->where(function ($whereCond) use ($filterData) {
            if (isset($filterData['start_date']) && isset($filterData['end_date']) && isset($filterData['delivery_status'])) {
                $whereCond->orWhereBetween('created_at', [date('Y-m-d', strtotime($filterData['start_date'])), date('Y-m-d', strtotime($filterData['end_date']))])->where('status', $filterData['delivery_status']);
            } elseif (isset($filterData['start_date']) && isset($filterData['end_date'])) {
                $whereCond->orWhereBetween('created_at', [date('Y-m-d', strtotime($filterData['start_date'])), date('Y-m-d', strtotime($filterData['end_date']))]);
            }
        })->orderBy('id', 'DESC')->paginate(10);

        return view('admin.smsCampaign.campaign.history', ['histories' => $messageHistory]);
    }


    private function checkCredit(){

        $client = new \GuzzleHttp\Client();
        $output = $client->post(
            'http://aakashsms.com/admin/public/sms/v1/credit',
            array(
                'form_params' => array(
                    'auth_token' => $this->tokenValue(),
                )
            )
        )->getBody();
        $obj = json_decode($output);

        return $obj->available_credit;
    }


}

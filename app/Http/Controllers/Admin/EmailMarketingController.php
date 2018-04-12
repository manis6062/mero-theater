<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TheaterMail;
use App\EmailGroup;
use App\EmailContactGroup;
use App\EmailCampaign;
use App\EmailContact;
use App\EmailMessageHistory;
use Illuminate\Http\Request;
use Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Auth;

class EmailMarketingController extends Controller
{
    public function index()
    {
        return view('admin.email-marketing.index');
    }

    public function campaignCreate()
    {
     $groups = EmailGroup::all();
     return view('admin.email-marketing.campaign-create',['items' => $groups]);
 }

 public function campaignManage(Request $request){
   $this->validate($request,[
    'campaign_name'=> 'required',
    'contacts_file'=>'required_without_all:group',
    'group'=>'required_without_all:contacts_file',
    'subject'=>'required',
    'message'=>'required'
]);
   $contacts_file = $request->contacts_file;
   $cname = $request->campaign_name;
   $gid = $request->group;
   $message = $request->message;
   $subject = $request->subject;
   if(isset($gid)&& !isset($request->contacts_file)){

     $contact_id=EmailContactGroup::find($gid)->emailcontact_id;
     $contacts = EmailContact::find($contact_id)->pluck('email','first_name');
     $data = array(
        'name'=>$request->campaign_name,
        'theater_id'=> Auth::guard('admin')->id(),
    );
     EmailCampaign::create($data);
     $email_campaign_id = EmailCampaign::where('name',$cname)->first()->id;
     foreach ($contacts as $key => $contact) {
        $history = array(
            'campaign_id'=>$email_campaign_id,
            'email'=>$contact,
            'name'=>$key,
            'source'=>'from admin',
            'subject'=>$subject,
            'message'=>$message,
        );
        EmailMessageHistory::create($history);
         $data = [
                'message'       => $message,
                'subject'       => $subject,
                'from'          => Auth::guard('admin')->user()->email,
                'from_name'     => 'Mero Threater',
                'reply_to'      => $contact,
                'reply_to_name' => 'Threater Admin',
                'category'      => 'category',
            ];
            $email=Mail::to($contact)->send(new TheaterMail($data));
        
    }
}elseif (!isset($gid) && isset($request->contacts_file)) {
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
      $data = array(
        'name'=>$request->campaign_name,
        'theater_id'=> Auth::guard('admin')->id(),
    );
      EmailCampaign::create($data);
      $email_campaign_id = EmailCampaign::where('name',$cname)->first()->id;
      foreach ($dataToImport as $values) {
        if(isset($values['name']) && isset($values['email']))
        {
            $insert['campaign_id']= $email_campaign_id;
            $insert['name'] = $values['name'];
            $insert['message']=$message;
            $insert['subject']=$subject;
            $insert['email'] = $values['email'];
            $insert['source']='from excel';
            if(filter_var($insert['email'],FILTER_VALIDATE_EMAIL)){
                $data = [
                'message'       => $message,
                'subject'       => $subject,
                'from'          => Auth::guard('admin')->user()->email,
                'from_name'     => 'Mero Threater',
                'reply_to'      => $values['email'],
                'reply_to_name' => 'Threater Admin',
                'category'      => 'category',
            ];
            $email=Mail::to($values['email'])->send(new TheaterMail($data));
                $result = EmailMessageHistory::create($insert);

            } else{
               $emailValidationData[] = $values['email'];
               return redirect('admin/email-marketing/campaign')->with('invalidEmailData', 'The excel file contain invalid email');
           }


       }else{
        return redirect('admin/email-marketing/campaign')->with('empty', 'Some of the fields are empty');
    }
}
}

if(count($emailValidationData) == 0)
{
    return redirect('admin/email-marketing/campaign')->with('message','Contact have been successfully imported.');
}
}

}elseif (isset($gid) && isset($request->contacts_file)) {
   $contact_id=EmailContactGroup::find($gid)->emailcontact_id;
   $contacts = EmailContact::find($contact_id)->pluck('email','first_name');
   $data = array(
    'name'=>$request->campaign_name,
    'theater_id'=> Auth::guard('admin')->id(),
);
   EmailCampaign::create($data);
   $email_campaign_id = EmailCampaign::where('name',$cname)->first()->id;
   foreach ($contacts as $key => $contact){
    $history = array(
        'campaign_id'=>$email_campaign_id,
        'email'=>$contact,
        'name'=>$key,
        'source'=>'from admin',
        'message'=>$message,
        'subject'=>$subject,
    );
     $data = [
                'message'       => $message,
                'subject'       => $subject,
                'from'          => Auth::guard('admin')->user()->email,
                'from_name'     => 'Mero Threater',
                'reply_to'      => $contact,
                'reply_to_name' => 'Threater Admin',
                'category'      => 'category',
            ];
            $email=Mail::to($contact)->send(new TheaterMail($data));
    EmailMessageHistory::create($history);
}
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
  $data = array(
    'name'=>$request->campaign_name,
    'theater_id'=> Auth::guard('admin')->id(),
);
  EmailCampaign::create($data);
  //$email_campaign_id = EmailCampaign::where('name',$cname)->first()->id;
  foreach ($dataToImport as $values) {
    if(isset($values['name']) && isset($values['email']))
    {
        $insert['campaign_id']= $email_campaign_id;
        $insert['name'] = $values['name'];
        $insert['subject']=$subject;
        $insert['message']=$message;
        $insert['email'] = $values['email'];
        $insert['source']='from excel';
        if(filter_var($insert['email'],FILTER_VALIDATE_EMAIL)){
             $data = [
                'message'       => $message,
                'subject'       => $subject,
                'from'          => Auth::guard('admin')->user()->email,
                'from_name'     => 'Mero Threater',
                'reply_to'      => $values['email'],
                'reply_to_name' => 'Threater Admin',
                'category'      => 'category',
            ];
            $email=Mail::to($values['email'])->send(new TheaterMail($data));
            $result = EmailMessageHistory::create($insert);
        } else{
           $emailValidationData[] = $values['email'];
           return redirect('admin/email-marketing/campaign')->with('invalidEmailData', 'The excel file contain invalid email');
       }


   }else{
    return redirect('admin/email-marketing/campaign')->with('empty', 'Some of the fields are empty');
}
}
}
if(count($emailValidationData) == 0)
{
    return redirect('admin/email-marketing/campaign')->with('message','Contact have been successfully imported.');
}
}
}
return redirect('admin/email-marketing/campaign')->with('Sucess','Email successfully sent');
}
public function sendMail()
{
    $data = [
        'message'       => '<H2>Hello test message</H2>',
        'custom_args'   => ['theater_id' => 112],
        'subject'       => 'Test Subject',
        'from'          => 'raznpra@gmail.com',
        'from_name'     => 'Mero Threater',
        'reply_to'      => 'raznpra@gmail.com',
        'reply_to_name' => 'Threater Admin',
        'category'      => 'category',
    ];

    Mail::to('es.binod.paneru@gmail.com')->send(new TheaterMail($data));
}
}

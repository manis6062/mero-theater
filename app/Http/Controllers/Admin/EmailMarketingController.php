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

    $cname = $request->campaign_name;
    $gid = $request->group;
    $message = $request->editor1;
     dd('test1');
    if(isset($gid)&& !isset($request->contact_file)){
        dd('first');
       $contact_id=EmailContactGroup::find($gid)->emailcontact_id;
       $contacts = EmailContact::find($contact_id)->pluck('email','first_name');
    //dd($contacts);
       $this->validate($request, [
        'campaign_name' => 'required',
        'editor1' => 'required'
    ]);
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
            'message'=>$message,
        );
        EmailMessageHistory::create($history);
    }
}elseif (!isset($gid) && isset($request->contact_file)) {
      dd('second');
  if(Input::hasFile('contact_file')){
      $path = Input::file('contact_file')->getRealPath();
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
            if(isset($values['name']) && isset($values['email']))
            {
               $insert['name'] = $values['name'];
               $insert['email'] = $values['email'];
               if(filter_var($insert['email'],FILTER_VALIDATE_EMAIL)){
                   $emailgroup_id=$request->group;
                   if ($request->has('group')) {
                    $result = EmailContact::create($insert);
                    $emailcontact_id =EmailContact::where('email',$insert['email'])->first()->id;
                    $emailcontact =EmailContact::find($emailcontact_id);
                    $emailcontact->groups()->attach($emailgroup_id);
                }
            } else{
                return redirect('admin/email-marketing/emailcontact/campaign-create')->with('invalidEmailData', 'The excel file contain invalid email');
            }
            $emailValidationData[] = $values['email'];

        }else{
            return redirect('admin/email-marketing/emailcontact/campaign-create')->with('empty', 'Some of the fields are empty');
        }
    }
}
if(count($emailValidationData) > 0)
{
    return redirect('admin/email-marketing/emailcontact/campaign-create')->with('emailErrorData', $emailValidationData)->with('emailErrorData', $emailValidationData);
}
if(count($emailValidationData) == 0)
{
    return redirect('admin/email-marketing/campaign-create')->with('message','Contact have been successfully imported.');
}
}else{

}

}elseif (isset($gid) && isset($request->contact_file)) {
      dd('first');
}

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

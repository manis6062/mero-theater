<?php

namespace App\Jobs;

use App\Http\Controllers\Admin\smsCampaign\sms\CampaignController;
use App\Models\MessageHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Exception\GuzzleException;

class SendSmsQueue extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $message_id;
    protected $message;

    /**
     * Create a new job instance.
     * Run a job for bulk sms chunked for 200 recipients at a time
     *
     * @param $message_id
     * @param $message
     */
    public function __construct($message_id,$message)
    {


        $this->message_id = $message_id;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $campaign=new CampaignController();
        $message =  $this->message;
        $messageId =  $this->message_id;
        MessageHistory::whereIn('id', $this->message_id)->chunk('300', function ($histories) use ($message,&$messageId,&$campaign) {
            $toNumber = [];



            foreach ($histories as $history) {
                $num = str_replace(' ', '', $history->recipient);
                $toNumber[] =(strlen($num) == 10) ? "977" . $num : $num;
            }



            // Send sms
            if (count($toNumber)) {


                $smsNumber = implode(',', $toNumber);


                try {
                    $client = new \GuzzleHttp\Client();
                    $output = $client->post(
                        'http://aakashsms.com/admin/public/sms/v1/send',
                        array(
                            'form_params' => array(
                                'from' => '31001',
                                'to' => $smsNumber,
                                'auth_token' => $campaign->tokenValue(),
                                'text' => $message
                            )
                        )
                    )->getBody();
                } catch (GuzzleException $exception) {
                    $responseBody = $exception->getResponse()->getBody(true);
                    $obj = json_decode($responseBody);
                    MessageHistory::whereIn("message_id",$messageId)->update([
                        'status' => 'failed',
                    ]);

                }
            }


        });


    }
}


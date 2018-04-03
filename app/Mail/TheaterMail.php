<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TheaterMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $from = $this->data['from'];
        $from_name = $this->data['from_name'];
        $reply_to = $this->data['reply_to'];
        $reply_to_name = $this->data['reply_to_name'];
        $subject = $this->data['subject'];
        $header=$this->asString(['category' => 'category',
            'unique_args' =>['id'=>123]]
        );
        if(isset($this->data['category'])&&isset($this->data['custom_args'])){
          $headerData = [
            'category' => $this->data['category'],
            'unique_args' => $this->data['custom_args']
        ];  
        $header = $this->asString($headerData);
        }
        $this->withSwiftMessage(function ($message) use ($header) {
            $message->getHeaders()
                    ->addTextHeader('X-SMTPAPI', $header);
        });

        return $this->view('email.threater_admin')
                    ->from($from, $from_name)
                    ->replyTo($reply_to, $reply_to_name)
                    ->subject($subject)
                    ->with([ 'data' => $this->data ]);
    }

    private function asJSON($data)
    {
        $json = json_encode($data);
        $json = preg_replace('/(["\]}])([,:])(["\[{])/', '$1$2 $3', $json);

        return $json;
    }


    private function asString($data)
    {
        $json = $this->asJSON($data);

        return wordwrap($json, 76, "\n   ");
    }
}

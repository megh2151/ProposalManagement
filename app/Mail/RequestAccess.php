<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestAccess extends Mailable
{
    use Queueable, SerializesModels;

    public $proposal;

    public function __construct($proposal)
    {
        $this->proposal = $proposal;
    }

    public function build()
    {
        return $this->view('emails.access-request')
                    ->subject('Proposal Access Request From Government User!');
    }
}

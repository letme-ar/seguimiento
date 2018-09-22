<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailWelcome extends Mailable
{
    use Queueable, SerializesModels;
    /**
     *
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url()->to('/login');
        return $this->view('mail.welcome')
                ->with("url",$url)
                ->subject(ENV('SYSTEM_NAME'));
    }
}

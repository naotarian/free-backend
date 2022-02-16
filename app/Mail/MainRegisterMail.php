<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MainRegisterMail extends Mailable
{
    use Queueable, SerializesModels;
    public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->url = $data['url'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('from_address@example.com')
                    ->view('mails.main_register')
                    ->subject('仮登録が完了しました。')
                    ->with([
                        'url' => $this->url,
                      ]);
    }
}

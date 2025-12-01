<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SimpleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @property string $subject
     * @property string $subject
     */
    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject = isset($this->data['subject']) ? $this->data['subject'] : 'no subject';
        $message = isset($this->data['message']) ? $this->data['message'] : 'no message';
        $bodySub = isset($this->data['bodySub']) ? $this->data['bodySub'] : 'no subject';

        return $this->from(config('mail.from.address'))
            ->subject($subject)
            ->markdown('emails.simple', [
                'message' => $message,
                'subject' => $bodySub,
            ]);
    }
}

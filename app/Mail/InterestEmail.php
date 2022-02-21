<?php

namespace App\Mail;

use App\Models\Cake;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Cake
     */
    private $cake;

    /**
     * Create a new message instance.
     *
     * @param Cake $cake
     */
    public function __construct(Cake $cake)
    {
        $this->cake = $cake;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.cake')
            ->subject('Enjoy, we already have available')
            ->with([
                'cake' => $this->cake,
            ]);
    }
}

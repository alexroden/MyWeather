<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendForecastEmail extends Mailable
{
    use Queueable,
        SerializesModels;

    /**
     * @var string
     */
    const SUBJECT = 'Your weekly weather forecast';

    /**
     * @var array
     */
    protected $forecast;

    /**
     * @var \App\User
     */
    protected $user;

    /**
     * @param \App\User $user
     * @param array     $forecast
     */
    public function __construct(User $user, array $forecast = [])
    {
        $this->user = $user;
        $this->forecast = $forecast;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.forecast')
            ->subject(self::SUBJECT)
            ->withUser($this->user)
            ->withForecast($this->forecast);
    }
}

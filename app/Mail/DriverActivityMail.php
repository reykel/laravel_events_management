<?php

namespace App\Mail;

use App\Models\Activity;
use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DriverActivityMail extends Mailable
{
    use Queueable, SerializesModels;

    public $activity;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
        $this->subject = "Assigned activity";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.driver_activity');
    }
}

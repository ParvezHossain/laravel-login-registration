<?php

namespace App\Listeners;

use App\Events\RegisterEvent;
use App\Mail\NewUserRegistration;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(RegisterEvent $event)
    {
        Mail::to($event->email)->send(new NewUserRegistration());
    }
}

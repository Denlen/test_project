<?php

namespace App\Listeners;

use App\Event\EmployeCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class SendEmployeCreatedEmail
//queble for better speed
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
     * @param  EmployeCreated  $event
     * @return void
     */
    public function handle(EmployeCreated $event)
    {
        $userEmails = User::select('email')->get();
        $newEmploye = $event->employe->only('first_name','last_name','id');
        $details = [
            'title' => 'New employe add',
            'body' => 'New employe '.$newEmploye['first_name'].' '.$newEmploye['last_name'].'.',
        ];
        foreach($userEmails as $email)
        {
            Mail::to($email)->send(new SendMail($details));
        }
    }
}

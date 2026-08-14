<?php

namespace App\Listeners;

use App\Events\StudentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\WelcomeStudentMail;
use App\Jobs\SendWelcomeEmailJob;


class SendWelcomeEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(StudentCreated $event): void
    {
        Log::info('Student Created Successfully', [
        'id' => $event->student->id,
        'name' => $event->student->name,
    ]);
    //  Mail::to('alisabirpt@gmail.com')
    //         ->send(new WelcomeStudentMail());

        SendWelcomeEmailJob::dispatch($event->student);
        // (new SendWelcomeEmailJob($event->student))->handle();
    }
}

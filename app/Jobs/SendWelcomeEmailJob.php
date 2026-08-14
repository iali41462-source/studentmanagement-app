<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeStudentMail;
use App\Models\User;
use App\Notifications\StudentWelcomeNotification;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
     public Student $student;
    /**
     * Create a new job instance.
     */
    public function __construct(Student $student)
    {
         $this->student = $student;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         $this->student->notify(
        new StudentWelcomeNotification($this->student)
    );
    }
}

<?php

namespace App\Notifications;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentWelcomeNotification extends Notification
{
    use Queueable;

    public Student $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to Student Management System')
            ->greeting('Hello ' . $this->student->name)
            ->line('Your registration has been completed successfully.')
            ->line('Thank you for using our application.');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}

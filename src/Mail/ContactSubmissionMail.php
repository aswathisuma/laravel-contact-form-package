<?php

namespace Trippledee\ContactForm\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Trippledee\ContactForm\Models\ContactSubmission;

class ContactSubmissionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $submission;

    public function __construct(ContactSubmission $submission)
    {
        $this->submission = $submission;
    }

    public function build()
    {
        return $this->subject('New Contact Submission: ' . $this->submission->subject)
                    ->view('contact-form::emails.contact_submission');
    }
}

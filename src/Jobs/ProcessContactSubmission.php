<?php

namespace Trippledee\ContactForm\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Trippledee\ContactForm\Mail\ContactSubmissionMail;
use Trippledee\ContactForm\Models\ContactSubmission;

class ProcessContactSubmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $submission;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ContactSubmission $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (config('contact-form.send_email_to_admin')) {
            $adminEmail = config('contact-form.admin_email', env('CONTACT_FORM_ADMIN_EMAIL'));
            if ($adminEmail) {
                try {
                    Mail::to($adminEmail)->send(new ContactSubmissionMail($this->submission));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send contact notification email: ' . $e->getMessage());
                }
            }
        }
    }
}

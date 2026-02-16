<?php

namespace Trippledee\ContactForm\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Trippledee\ContactForm\Models\ContactSubmission;
use Trippledee\ContactForm\Mail\ContactSubmissionMail;
use Trippledee\ContactForm\Jobs\ProcessContactSubmission;

class ContactController extends Controller
{
    public function index()
    {
        $submissions = ContactSubmission::where('user_id', auth()->id())->get();
        return response()->json($submissions);
    }
}

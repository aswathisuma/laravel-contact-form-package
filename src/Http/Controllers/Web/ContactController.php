<?php

namespace Trippledee\ContactForm\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Trippledee\ContactForm\Models\ContactSubmission;
use Trippledee\ContactForm\Jobs\ProcessContactSubmission;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $submission = ContactSubmission::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'user_id' => auth()->id(),
        ]);

        // Dispatch Job to send email
        ProcessContactSubmission::dispatch($submission);

        return back()->with('success', 'Contact form submitted successfully.');
    }
}

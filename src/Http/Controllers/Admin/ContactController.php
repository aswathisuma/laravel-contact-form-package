<?php

namespace Trippledee\ContactForm\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Trippledee\ContactForm\Models\ContactSubmission;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactSubmission::query();

        if ($request->has('user_name') && $request->user_name) {
            $query->where('name', 'like', '%' . $request->user_name . '%');
        }

        if ($request->has('date') && $request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $submissions = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('contact-form::admin.index', compact('submissions'));
    }
}

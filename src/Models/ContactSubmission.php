<?php

namespace Trippledee\ContactForm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(\Trippledee\ContactForm\Models\User::class);
    }
}

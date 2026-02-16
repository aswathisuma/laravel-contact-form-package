<?php

use Illuminate\Support\Facades\Route;
use Trippledee\ContactForm\Http\Controllers\Admin\ContactController as AdminContactController;
use Trippledee\ContactForm\Http\Controllers\Admin\LoginController;
use Trippledee\ContactForm\Http\Controllers\Web\ContactController as WebContactController;

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('contact-form::contact');
    });

    Route::post('/contact', [WebContactController::class, 'store'])->name('contact.store');

    Route::get('/contact-status', function () {
        return "The Contact system is operational.";
    });

    Route::get('/admin', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/admin/contact-submissions', [AdminContactController::class, 'index'])->name('admin.contact-submissions');
    });
});

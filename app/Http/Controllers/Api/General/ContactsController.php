<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Forntend\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactNotifaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ContactRequest $request)
    {
        $request->validated();
        $request->merge(['ip_address' => $request->ip()]);
        $contact = Contact::create($request->all());
        if (!$contact) {
            return apiResponse(404, 'Try Again letter ');
        }
        $admins = Admin::get();
        Notification::send($admins, new NewContactNotifaction($contact));
        return apiResponse(200, 'Contact send successfuly');
    }
}

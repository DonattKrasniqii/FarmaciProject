<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Repositories\ContactMessagesRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contactMessagesRepository;

    public function __construct(ContactMessagesRepository $contactMessagesRepository)
    {
        $this->contactMessagesRepository = $contactMessagesRepository;
    }

    public function contactView()
    {
        return view('templates.web.contact.index');
    }

    public function saveContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'name2' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'message' => 'required'
        ]);
        if ($this->contactMessagesRepository->store($request)) {
            return redirect()->back()->with('message', 'Faleminderit për mesazhin ! Do ju kontaktojmë shumë shpejtë.');
        } else {
            return redirect()->back()->with('message', 'Gabim në procesim! Provoni përseri.');
        }
    }

    public function markasRead($id){



        $this->contactMessagesRepository->markContactasRead($id);


        return redirect()->back();

    }
}

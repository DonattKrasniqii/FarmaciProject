<?php


namespace App\Repositories;


use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactMessagesRepository
{

    public function store(Request $request)
    {

        $apiPath = env('API_ACTION');

       $response =  Http::post($apiPath .'/saveContact',[
           'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone_number' => $request->get('phone_number'),
            'message' => $request->get('message')
        ]);


       return $response->successful();
    }

    public function getAll()
    {

        $apiPath = env('API_ACTION');

        $response =  Http::get($apiPath.'/getContacts');

        $arrayOfObjects = $response->json();

        $contacts = [];


        for($i=0;$i<count($arrayOfObjects);$i++){
            $contact = new Contact();
            $contact->id = $arrayOfObjects[$i]['id'];
            $contact->name  = $arrayOfObjects[$i]['name'];
            $contact->email = $arrayOfObjects[$i]['email'];
            $contact->phone_number =$arrayOfObjects[$i]['phone_number'];
            $contact->message =$arrayOfObjects[$i]['message'];

            $contacts[] = $contact;

        }

        return $contacts;
    }


    public function markContactasRead($id){

        $apiPath = env('API_ACTION');

        $response =  Http::post($apiPath .'/saveContact',[
            'id' => $id
        ]);

        return $response->successful();
    }

}

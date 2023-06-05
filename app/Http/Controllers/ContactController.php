<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
    use Illuminate\Support\Str;


class ContactController extends Controller
{
    //
    public function createContact(Request $request){
      try {
    $data = [
        "name" => $request->name,
        "email" => $request->email,
        "phone" => $request->phone,
        "subject" => $request->subject,
        "message" => $request->message
    ];

    $contact=Contact::create($data);
    logger($contact);
    return response()->json([
        "message" => "Sent successfully"
    ]);
    } catch (\Exception $e) {
    // Handle the error here
    return response()->json([
        "message" => "Error occurred while sending the message"
    ], 500); // Return an appropriate HTTP status code (e.g., 500 for server error)
    }

    }
    //

public function getContacts(){
    $contacts = Contact::get();

    // Truncate the 'message' field for each contact
    foreach ($contacts as $contact) {
        $contact->message = Str::limit($contact->message, 10); // Limiting to 100 characters
    }

    return view('customerContact', compact('contacts'));
    }

    // customer message detail

    public function getMessage($id){
        $message=Contact::where('contact_id',$id)->get();
        return view('readMessage',compact('message'));
    }
    // customer message delete

    public function deleteMessage($id){
        $message=Contact::where('contact_id',$id)->delete();
         $contacts = Contact::get();

    // Truncate the 'message' field for each contact
        foreach ($contacts as $contact) {
        $contact->message = Str::limit($contact->message, 10); // Limiting to 100 characters
        }

        return redirect()->route('contact#getContacts',compact('contacts'))->with(['deleteSuccess'=>'deleted Success']);


    }

}

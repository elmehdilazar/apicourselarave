<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\ContactResource;
use App\Models\contact;
use Database\Factories\ContactFactory;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact =contact::all();
        return new ContactCollection(contact::all());
    }
    //feltre data
  protected function contactToarray($data) : array {
  foreach ($data as $key => $value) {
    $contact["name"]=$value["name"];
    $contact["tel"]=$value["tel"];
  }
  return $contact;
  }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactRequest $request)
    {
       $contact = contact::create(
        [
        "name"=>$request->name,
        "tel"=>$request->tel
        ]
        );
        return $contact;
    }

    /**
     * Display the specified resource.
     */
    public function show(contact $contact)
    {
        // $data["name"] = $contact["name"];
        // $data["tel"] = $contact["tel"];
        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest $request, contact $contact)
    {
       $data= $contact->update(
            [
              "name"=>$request->name,
        "tel"=>$request->tel]
        );
        return response()->json($contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(contact $contact)
    {
        $contact->deleteOrFail();
        return response()->json($contact);
    }
}

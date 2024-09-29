<?php
require_once "controller/application_controller.php";
require_once "model/contact.php";

class ContactsController extends ApplicationController
{
  public function index()
  {
    $contacts = Contact::all();
    return $this->view('grade', ['contacts' => $contacts]);
  }

  public function create() { return $this->view('form'); }

  public function edit($data)
  {
    $contact = Contact::find((int) $data['id']);

    return $this->view('form', ['contact' => $contact]);
  }

  public function save() 
  {
    $contact = new Contact();
    $contact->name = $this->request->name;
    $contact->email = $this->request->phone;
    $contact->phone = $this->request->email;

    if($contact->save()) { return $this->index(); }
  }
  
  public function update($data)
  {
    $contact = Contact::find((int) $data['id']);
    $contact = $this->request->name;
    $contact = $this->request->phone;
    $contact = $this->request->email;
    $contact->save();

    return $this->index();
  }

  public function destroy($data)
  {
    Contact::destroy((int) $data['id']);

    return $this->index();
  }
}
?>
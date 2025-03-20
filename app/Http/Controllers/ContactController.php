<?php

namespace App\Http\Controllers;

use App\Models\AccountModel;
use App\Models\ContactModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function manage_contacts()
    {
        $data['contacts'] = ContactModel::where('user_id', Auth::user()->id)->with('getAccountDetail')->get();

        return view('contacts.manage_contacts')->with($data);
    }
    public function add_contact(Request $req)
    {

        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'contact_name' => 'required',
                'account_id' => 'required',
                'phone' => 'required',
            ]);
            // create account
            $contact = new ContactModel();
            $contact->user_id = Auth::user()->id;
            $contact->contact_name = $req['contact_name'];
            $contact->account_id = $req['account_id'];
            $contact->phone = $req['phone'];
            $contact->email = $req['email'];
            $contact->save();

            return redirect('/contacts/manage-contacts');
        }

        $data['account_list'] = AccountModel::where('user_id', Auth::user()->id)->get();
        return view('contacts.add_contact')->with($data);
    }

    public function edit_contact($id, Request $req)
    {
        $data['contact_detail'] = ContactModel::find($id);
        if ($data['contact_detail'] == '') {
            return redirect('contacts/manage-contacts');
        }
        $submit = $req['submit'];
        if ($submit == "submit") {
            $req->validate([
                'contact_name' => 'required',
                'account_id' => 'required',
                'phone' => 'required',
            ]);
            // create account
            $data['contact_detail']->contact_name = $req['contact_name'];
            $data['contact_detail']->account_id = $req['account_id'];
            $data['contact_detail']->phone = $req['phone'];
            $data['contact_detail']->email = $req['email'];
            $data['contact_detail']->save();

            return redirect('/contacts/manage-contacts');
        }


        $data['account_list'] = AccountModel::where('user_id', Auth::user()->id)->get();
        return view('contacts.edit_contact')->with($data);
    }

    public function delete_contact($id = 0)
    {
        $contact = ContactModel::find($id);
        if ($contact == '') {
            return redirect('/contacts/manage-contacts');
        }

        $contact->delete();
        return redirect('/contacts/manage-contacts');
    }
}

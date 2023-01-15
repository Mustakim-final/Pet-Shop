<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function contacthome()
    {
        return view('Admin.Contact.index');
    }

    public function contactpost(Request $request)
    {
        $request->validate([
            'address'=> 'required',
            'email'=> 'required',
            'phone'=>'required',
        ]);

        $data= array();

        $data['number']=$request->phone;
        $data['email']=$request->email;
        $data['address']=$request->address;
        $data['status']=$request->status;

        Contact::insert($data);

        $notification=array('message'=>'Contact Inserted','alert-type'=>'success');
        return redirect()->back()->with($notification);

    }

    public function contarctshow()
    {
        $contact=Contact::all();
        return view('Admin.Contact.show',compact('contact'));
    }

    public function contactupdatepage($id)
    {
        $contact=Contact::find($id);
        return view('Admin.Contact.edit',compact('contact'));
    }

    public function contactupdate(Request $request,$id)
    {
        $data= array();

        $data['number']=$request->number;
        $data['email']=$request->email;
        $data['address']=$request->address;
        $data['status']=$request->status;

        DB::table('contacts')->where('id',$id)->update($data);

        $notification=array('message'=>'Contact update','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {
        $contact=Contact::find($id)->delete();
        $notification=array('message'=>'Contact delete','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}

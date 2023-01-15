<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function homepage()
    {
        $contact=Contact::all();
        return view('welcome',compact('contact'));
    }
}

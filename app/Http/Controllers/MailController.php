<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\SampleNotification;

class MailController extends Controller
{
  public function SampleNotification()
  {
    $name = 'lacalhost Master';
    $text = 'これからもよろしくお願いいたします。';
    // TODO change to your address.
    $to = 'your_address@your_domain';
    Mail::to($to)->send(new SampleNotification($name, $text));

    return view('emails.send_complete');
  }
}

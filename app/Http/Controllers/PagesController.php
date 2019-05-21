<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use Mail;
use Session;

use App\Mail\OrderShipped;


class PagesController extends Controller{
    public function getIndex(){
        $posts = Post::orderBy('created_at', 'desc')->limit(5)->get();
        return view('pages.welcome', compact('posts'));
    }

    public function getAbout(){
        $first ="Mohammad";
        $last ="Farhad";

        $fullname = $first . " " . $last;
        $email = "farhadamcse@gmail.com";
        $data = [];
        $data['fullname'] = $fullname;
        $data['email'] = $email;
         return view('pages.about')->withData($data);
    }

    public function getContact(){
        return view('pages.contact');
    }


    public function postContact(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Ship order...

        Mail::to($request->user())->send(new OrderShipped($post));
    }


    /*public function postContact(REquest $request){
        $this->validate($request, [
            'email' => 'required|email',
            'subject' => 'min:3',
            'message' => 'min:10'
        ]);

        $data = array(
            'email' => $request->email,
            'subject'=> $request->subject,
            'bodyMessage' => $request->message
            
        );

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('farhad@mailtrap.io');
            $message->subject($data['subject']);
        });

        echo"<pre>";
        print_r($message);
        exit();

        Session::flash('success', 'The mail was successfully sent!');
        return redirect()->url('/'); 

       }*/


    


    /*public function create(){
        return view('posts.create');
    }*/
}
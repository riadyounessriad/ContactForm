<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

use Validator;
use Response;
use Mail;

use Illuminate\Support\Facades\Input;


class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {

         app()->setlocale("fr");
    
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
            
        $rules = array(
            'sujet' => 'required',
            'email' => 'required',
            'description' => 'required|max:200',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(

                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $data = new Contact ();
            $data->email = $request->email;
            $data->sujet = $request->sujet;
            $data->description = $request->description;
            $data->save ();
            $email = $request->email;
            $sujet = $request->sujet;
            $description = $request->description;



            $data = array('email'=>$email,'sujet'=>$sujet, "description" =>$description);
                Mail::send('contacts.mail',$data, function($message) use ($email,$sujet, $description) {
                $message->to("olivia.declerck@dkgroup.fr")
                ->subject($sujet);
                $message->from("olivia.declerck@dkgroup.fr","ContactForm");
            });

            if (Mail::failures()) {
                return Response::json(array(
                     'errors' => ['error' =>"Le message n'a pas été envoyé, vérifiez votre email" ],
                ));
 
             }

            return response ()->json (['success' =>"Le message a été bien envoyé" ] );

        }        
        


        

    }

}
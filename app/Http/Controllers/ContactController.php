<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{

    public function getForm()
    {
		return view('contact');
	}

	public function postForm(ContactRequest $request)
	{
		// Les regles de validation se trouve dans app/http/request
		// $this->validate($request, [
		// 	'nom' => 'required|min:5|max:255',
		// 	'email' => 'required|email',
		// 	'texte' => 'required|min:5',
		// 	]);
		
		// Il faut aussi modofier le fichier .env pour ajouter les donner du serveur mail
		
		// MAIL_DRIVER=smtp
		// MAIL_HOST=smtp.free.fr
		// MAIL_PORT=25
		// MAIL_USERNAME=null
		// MAIL_PASSWORD=null
		// MAIL_ENCRYPTION=""
		
		// et modifier config/mail.php 'from' => ['address' => 'moi@free.fr', 'name' => 'Administrateur'],
		
		// Mail::send('emails.contact', $request->all(), function($message){
		// 	$message->to('test@impossible.pasvalide')->subject('Contact');
		// });

		return view('confirm');
	}

}
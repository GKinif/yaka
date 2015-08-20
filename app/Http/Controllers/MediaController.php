<?php 

namespace App\Http\Controllers;

use App\Http\Requests\MediaRequest;
use App\Gestion\MediaGestionInterface;

class MediaController extends Controller 
{

    public function getForm()
	{
		return view('photo');
	}

	public function postForm(MediaRequest $request, MediaGestionInterface $mediaGestion)
	{
		if ($mediaGestion->save($request->file('image'))){
			return view('photo_ok');
		}
		return redirect('photo/form')->with('error', 'Votre image ne peut pas être envoyée !');
	}

}
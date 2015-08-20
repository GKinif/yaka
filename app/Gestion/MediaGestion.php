<?php 

namespace App\Gestion;

class MediaGestion implements MediaGestionInterface{

    public function saveProduitImage($image, $postfix, $prod_slug)	{
    	$imageNom = null;
		if( $image->isValid() ) {
			$chemin = config('media.pathProduit');
			$extension = $image->getClientOriginalExtension();

			$imageNom = $prod_slug . '_' . $postfix . '.' . $extension;
			$image->move($chemin, $imageNom);
		}

		return $imageNom;
	}

}
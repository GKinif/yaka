<?php

namespace App\Gestion;

interface MediaGestionInterface{
	public function saveProduitImage($image, $postfix, $prod_slug);
}
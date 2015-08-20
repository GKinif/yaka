<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RequestProduit extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'prod_nom' => 'required|max:20',
            'prod_slug' => 'required|max:20',
            'prod_image' => 'required|image',
            'prod_vignette' => 'required|image',
            'prod_descr_courte' => 'required|max:100',
            'prod_descr_longue' => 'required|max:500',
            
            'cat_slug' => 'required|max:25',
            'new_cat_nom' => 'max:25',
            'new_cat_slug' => 'max:25',
            'sscat_slug' => 'required|max:30',
            'new_sscat_nom' => 'max:30',
            'new_sscat_slug' => 'max:30',
            
        ];
    }
}

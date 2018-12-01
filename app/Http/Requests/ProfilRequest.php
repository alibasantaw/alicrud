<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilRequest extends FormRequest
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

    public function rules()
    {
        return [
            'profil_nama'=>'required|max:255',
            'profil_email'=>'required|max:255',
            'profil_dob'=>'required',
            'profil_telepon'=>'required',
            'profil_gender'=>'required',
            'profil_alamat'=>'required', 
            
        ];
    }
}

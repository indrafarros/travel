<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TerminalRequestStore extends FormRequest
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
            'code' => 'required',
            'name' => 'required',
            'address' => 'required',
            'provinsi' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'tipe' => 'required'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProposeRequest extends FormRequest
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
            'usulan_hp[]' => 'required',
            'jumlah_hp[]' => 'required',
            'spesifikasi_hp[]' => 'required',
            'justifikasi_hp[]' => 'required',
            'usulan_thp[]' => 'required',
            'jumlah_thp[]' => 'required',
            'spesifikasi_thp[]' => 'required',
            'justifikasi_thp[]' => 'required',
        ];
    }
}

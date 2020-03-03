<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCidRequest extends FormRequest
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
            'cid' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'should_send_msg' => 'required|boolean',
            'is_estigmatizado' => 'required|boolean',
        ];
    }
}

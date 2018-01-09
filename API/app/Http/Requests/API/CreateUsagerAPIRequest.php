<?php

namespace App\Http\Requests\API;

use App\Models\Usager;
use InfyOm\Generator\Request\APIRequest;

class CreateUsagerAPIRequest extends APIRequest
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
        return Usager::$rules;
    }
}

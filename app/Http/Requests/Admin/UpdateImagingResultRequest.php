<?php

namespace App\Http\Requests\Admin;

use App\Models\Admin\ImagingResult;
use Illuminate\Foundation\Http\FormRequest;

class UpdateImagingResultRequest extends FormRequest
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
        $rules = ImagingResult::$rules;
        
        return $rules;
    }
}

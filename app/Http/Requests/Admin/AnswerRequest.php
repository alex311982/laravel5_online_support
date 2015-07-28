<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 7/24/15
 * Time: 12:42 AM
 */

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;


class AnswerRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

} 
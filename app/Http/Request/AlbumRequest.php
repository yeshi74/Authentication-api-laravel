<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class AlbumRequest extends FormRequest
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
            'subject' => 'required|max:5',
            'author' => 'required',
            'location' => 'required'
        ];
    }
     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'sujbect.max' => 'Subject field should be 5 characters!',
            'name.required' => 'Name is required!',
            'password.required' => 'Password is required!'
        ];
    }
}
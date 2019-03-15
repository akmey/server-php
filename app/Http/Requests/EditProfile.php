<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class EditProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::guest()) {
            return false;
        } else {
            return true;
        }
    }

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
     * Get the error messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.regex' => 'Username can only be composed of letters and numbers.',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->sometimes('username', 'max:50|unique:users,name|regex:/^[A-Za-z0-9]+$/', function($input) {
            return !empty($input->username);
        });
        $validator->sometimes('email', 'email|unique:users', function($input) {
            return !empty($input->email);
        });
        $validator->sometimes('password', 'min:8|string', function($input) {
            return !empty($input->password);
        });
        $validator->sometimes('bio', 'min:10|string|max:2500', function($input) {
            return !empty($input->bio);
        });
        $validator->sometimes('profilepic', 'image|mimes:jpeg,png,jpg,gif,svg|max:4096', function($input) {
            return !empty($input->profilepic);
        });
    }
}

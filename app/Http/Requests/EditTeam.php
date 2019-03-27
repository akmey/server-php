<?php

namespace App\Http\Requests;

use Auth;
use App\Team;
use Illuminate\Foundation\Http\FormRequest;

class EditTeam extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $team = Team::find($this->route('teamid'));
        return $team && Auth::user()->can('update', $team);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'nullable|string|unique:teams|regex:/^[A-Za-z0-9]+$/',
            'bio' => 'required',
            'adminopen' => ['required', 'string', 'regex:/^yes|no$/']
        ];
    }
}

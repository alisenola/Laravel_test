<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Hash, Auth};
use Carbon\Carbon;
use App\Models\User;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */
    public function login()
    {

        #Get user
        $user = User::where('username', $this->username)->first();

        if (is_null($user) or !Hash::check($this->password, $user->password)) {
            throw new \Exception('Incorrect username or password!');
        }

        // #Start authentication
        Auth::login($user);
        session()->regenerate();

        session()->flash('success', 'You have surrcessfully logged in.');
        return redirect()->route('home');
    }
}
<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Hash, Auth};
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Tools\Converter;
use App\Models\User;

class RegisterRequest extends FormRequest
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
            'username' =>
                'required|unique:users,username|alpha_num|min:4|max:20',
            'password' => 'required|min:8|max:80|confirmed',
        ];
    }

    /**
     * Database persist
     *
     * @return Illuminate\Routing\Redirector
     */
    public function register()
    {
        $user = new User();
        $user->username = $this->username;
        $user->password = Hash::make($this->password);
        $user->avatar = Converter::convert_into_base64(
            public_path('img/avatar.png')
        );

        $user->save();

        Auth::login($user);
        session()->regenerate();

        session()->flash(
            'success',
            $this->username . ' have successfully registered.'
        );
        return redirect()->route('home');
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreUserRequest extends FormRequest
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
            'name'=>'required|unique:users',
            'email'=>'required|unique:users',
        ];
    }

    public function store(StoreUserRequest $request)
    {

        $role_user = Role::where('name', 'user')->first();
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make('secret'),
        ]);
        //by default role_user
        $user->roles()->attach($role_user);
        return redirect()->route('users.index');
    }
}

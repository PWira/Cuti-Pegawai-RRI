<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:50'],
            'user_nip'=>[
                'required',
                'string',
                'max:20',
                Rule::unique(User::class),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:50',
                Rule::unique(User::class),
            ],
            'roles'=>[
                'required',
                'string',
                'max:20',
            ],
            'hak'=>[
                'required',
                'string',
                'max:20',
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'user_nip' => $input['user_nip'],
            'email' => $input['email'],
            'roles' => $input['roles'],
            'hak' => $input['hak'],
            'password' => Hash::make($input['password']),
        ]);
    }
}

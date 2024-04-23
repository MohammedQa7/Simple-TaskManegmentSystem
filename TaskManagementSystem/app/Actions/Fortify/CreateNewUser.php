<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

        
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        if(request('task_maneger') == 1 && !is_null(request('task_maneger'))){
            return User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'company_position' => implode('/' ,request('position'))?? null ,
                'password' => Hash::make($input['password']),
                'role' => User::ROLE_MANEGER,
            ]);
        }else{
            return User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'company_position' => implode('/' ,request('position')) ?? null ,
                'password' => Hash::make($input['password']),
            ]);
        }
    }
}

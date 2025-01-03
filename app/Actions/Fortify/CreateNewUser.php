<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\interiorDesigner;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
            'role' => ['required', 'string', 'in:customer,designer'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'profile' => 'nullable|file|image|max:2048', // Validate profile file
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'],
        ]);

        if ($input['role'] === 'designer') {
            if (Request::hasFile('profile')) {
                $image1 = Request::file('profile');
                $ext = time() . '.' . $image1->getClientOriginalExtension(); // Use time for a unique name
                $image1->move(public_path('Images'), $ext); // Ensure the directory exists and is writable

                interiorDesigner::create([
                    'user_id' => $user->id,
                    'profile' => $ext,
                    'bio' => $input['bio'],
                    'portfolio_link' => $input['link'],
                ]);
            }
        }

        return $user;
    }


}

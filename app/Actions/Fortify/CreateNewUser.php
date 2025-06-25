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
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'interest_tags' => ['nullable', 'string'],
        ])->validate();

        $tagsString = $input['interest_tags'] ?? null;
        $finalTags = null;
        if ($tagsString) { // Only proceed if $tagsString is non-empty and not null
            $tagsArray = array_map('trim', explode(',', $tagsString));
            // Filter out any tags that became empty after trimming (e.g., from "tag1, , tag2")
            $tagsArray = array_filter($tagsArray, function($tag) {
                return !empty($tag);
            });
            if (!empty($tagsArray)) {
                $finalTags = array_values($tagsArray); // Ensure it's a list like ['tag1', 'tag2']
            }
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'interest_tags' => $finalTags,
        ]);
    }
}

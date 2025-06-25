<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user registration with interest tags.
     */
    public function test_user_can_register_with_interest_tags(): void
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'interest_tags' => 'laravel, php, web development',
        ];

        $response = $this->post(route('register'), $userData);

        $response->assertRedirect(config('fortify.home'));
        $this->assertAuthenticated();

        $user = User::where('email', $userData['email'])->first();
        $this->assertNotNull($user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertTrue(Hash::check($userData['password'], $user->password));
        $this->assertEquals(['laravel', 'php', 'web development'], $user->interest_tags);
    }

    /**
     * Test user registration without interest tags.
     */
    public function test_user_can_register_without_interest_tags(): void
    {
        $userData = [
            'name' => 'Another User',
            'email' => 'another@example.com',
            'password' => 'password456',
            'password_confirmation' => 'password456',
            'interest_tags' => null,
        ];

        $response = $this->post(route('register'), $userData);

        $response->assertRedirect(config('fortify.home'));
        $this->assertAuthenticated();

        $user = User::where('email', $userData['email'])->first();
        $this->assertNotNull($user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertTrue(Hash::check($userData['password'], $user->password));
        $this->assertNull($user->interest_tags);
    }

     /**
     * Test user registration with empty string for interest tags.
     */
    public function test_user_can_register_with_empty_interest_tags(): void
    {
        $userData = [
            'name' => 'Empty Tags User',
            'email' => 'emptytags@example.com',
            'password' => 'password789',
            'password_confirmation' => 'password789',
            'interest_tags' => '',
        ];

        $response = $this->post(route('register'), $userData);

        $response->assertRedirect(config('fortify.home'));
        $this->assertAuthenticated();

        $user = User::where('email', $userData['email'])->first();
        $this->assertNotNull($user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertTrue(Hash::check($userData['password'], $user->password));
        $this->assertNull($user->interest_tags, "Interest tags should be null when an empty string is provided.");
    }

    public function test_user_model_saves_and_retrieves_tags_directly(): void
    {
        // Case 1: Non-empty array
        $user1 = User::factory()->create([
            'interest_tags' => ['tag1', 'tag2'],
        ]);
        $retrievedUser1 = User::find($user1->id);
        $this->assertNotNull($retrievedUser1);
        $this->assertEquals(['tag1', 'tag2'], $retrievedUser1->interest_tags, "Failed for non-empty array ['tag1', 'tag2'].");

        // Case 2: Empty array
        $user2 = User::factory()->create([
            'interest_tags' => [],
        ]);
        $retrievedUser2 = User::find($user2->id);
        $this->assertNotNull($retrievedUser2);
        $this->assertEquals([], $retrievedUser2->interest_tags, "Failed for empty array [].");

        // Case 3: Array with a single empty string
        $user3 = User::factory()->create([
            'interest_tags' => [''],
        ]);
        $retrievedUser3 = User::find($user3->id);
        $this->assertNotNull($retrievedUser3);
        // Let's find out what [''] becomes. If it's an array cast, it should likely stay ['']
        // or be treated as special by SQLite (JSON1 extension usually handles JSON).
        // Based on the previous test runs, it seems like [''] might become null after save/retrieve.
        // This is consistent with the test_user_can_register_with_empty_interest_tags (input '')
        // which uses the old CreateNewUser logic that would have produced [''] and expected null.
        // However, our current CreateNewUser logic converts '' input to null directly.
        // So, for this direct test, let's see. If [''] from factory results in null, it's a data point.
        $this->assertEquals([''], $retrievedUser3->interest_tags, "Failed for array [''].");
        // If the above fails and it's actually null, then we know [''] is treated as null by DB/cast.
    }
}

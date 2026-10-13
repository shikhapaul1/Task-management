<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using login', function () {
    $user = User::factory()->create([
        'role' => 'Developer',
        'status' => 'active',
    ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticatedAs($user);
});

test('users cannot authenticate with invalid credentials', function () {
    $user = User::factory()->create([
        'role' => 'Developer',
        'status' => 'active',
    ]);

    $response = $this->from('/login')->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertRedirect('/login');
    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register via logincontroller', function () {
    $response = $this->post('/register', [
        'name' => 'Alex Morgan',
        'email' => 'alex@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'role' => 'Developer',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();

    $this->assertDatabaseHas('users', [
        'name' => 'Alex Morgan',
        'email' => 'alex@example.com',
        'role' => 'Developer',
        'status' => 'active',
    ]);
});

test('registration validates required fields', function () {
    $response = $this->from('/register')->post('/register', [
        'name' => '',
        'email' => 'not-an-email',
        'password' => 'pass',
        'password_confirmation' => 'mismatch',
    ]);

    $response->assertRedirect('/register');
    $response->assertSessionHasErrors(['name', 'email', 'password']);
    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create([
        'role' => 'Developer',
        'status' => 'active',
    ]);

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/login');
});

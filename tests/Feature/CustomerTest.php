<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Enums\TransactionType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * An user can create a new account with username and password
     */
    public function test_an_user_can_create_a_new_account_with_username_and_password(): void
    {
        $this->withoutExceptionHandling();

        $password = Hash::make('123456');

        $response = $this->post('/register', [
            'username' => 'john_doe-123',
            'name' => 'John Doe',
            'email' => 'john_doe@example.com',
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john_doe@example.com'
        ]);

        $response->assertStatus(302);

        $this->assertAuthenticated();
    }

    /**
     * An user starts with 0 balance
     */
    public function test_an_user_starts_with_zero_balance(): void
    {
        $this->withoutExceptionHandling();

        $password = Hash::make('123456');

        $this->post('/register', [
            'username' => 'john_doe-123',
            'name' => 'John Doe',
            'email' => 'john_doe@example.com',
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $user = User::first();

        $this->assertDatabaseHas('accounts', [
            'user_id' => $user->id,
            'balance' => 0,
        ]);
    }

    /**
     * An user can deposit more money to his account by uploading
     * a picture of a check and entering the amount of the check.
     */
    public function test_an_user_can_deposit_more_money_to_his_account(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('check.jpg');

        $response = $this->actingAs($user)->post('/checks/new',
        [
            'description' => "Grandmas's Gift",
            'amount' => 300.00,
            'file' => $file,
        ]);

        $response->assertStatus(201);

        Storage::assertExists($file->hashName());
    }

    /**
     * To buy something, the user enters the amount and description; a user can only buy something if she has enough money to cover the cost.
     */
    public function test_an_user_can_buy_something(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(['balance' => 10000]);

        $response = $this->actingAs($user)->post('/expenses/new',
        [
            'description' => "Grandmas's Gift",
            'amount' => 5000,
            'date' => Carbon::now(),
        ]);

        $response->assertStatus(201);
    }

    /**
     * A user can only buy something if she has enough money to cover the cost.
     */
    public function test_an_user_can_not_buy_something_if_have_not_enough_money(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(['balance' => 10000]);

        $response = $this->actingAs($user)->post('/expenses/new',
        [
            'description' => "Grandmas's Gift",
            'amount' => 30000,
            'date' => Carbon::now(),
        ]);

        $response->assertStatus(422);
    }

    /**
     * To buy something, the user enters the amount and description; a user can only buy something if she has enough money to cover the cost.
     */
    public function test_when_an_user_buys_something_the_balance_is_subtracted(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(['balance' => 10000]);

        $response = $this->actingAs($user)->post('/expenses/new',
        [
            'description' => "Grandmas's Gift",
            'amount' => 5000.00,
            'date' => Carbon::now(),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'balance' => 500000
        ]);
    }

    /**
     * An user can see a list of balance changes including time and description.
     */
    public function test_an_user_can_see_a_list_of_balance_changes(): void
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create(['balance' => 10000]);

        $transactionOne = Transaction::factory()->create([
            'user_id' => $user,
            'type_id' => TransactionType::EXPENSE,
            'description' => 'T-shirt',
            'amount' => 50,
            'date' => Carbon::now(),
        ]);

        $transactionTwo = Transaction::factory()->create([
            'user_id' => $user,
            'type_id' => TransactionType::EXPENSE,
            'description' => 'Groceries',
            'amount' => 100,
            'date' => Carbon::now(),
        ]);

        $response = $this->actingAs($user)->get('/expenses');

        $response->assertStatus(200);

        $response->assertSee($transactionOne->description);
        $response->assertSee($transactionTwo->description);
    }

}

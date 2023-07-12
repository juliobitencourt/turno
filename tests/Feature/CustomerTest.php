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
        $password = Hash::make('123456');

        $response = $this->post('/register', [
            'username' => 'john_doe',
            'name' => 'John Doe',
            'email' => 'john_doe@example.com',
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(201);
    }

    /**
     * An user starts with 0 balance
     */
    public function test_an_user_starts_with_zero_balance(): void
    {
       $password = Hash::make('123456');

        $response = $this->post('/register', [
            'username' => 'john_doe',
            'name' => 'John Doe',
            'email' => 'john_doe@example.com',
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john_doe@example.com',
            'balance' => 0,
        ]);
    }

    /**
     * An user can deposit more money to his account by uploading
     * a picture of a check and entering the amount of the check.
     */
    public function test_an_user_can_deposit_more_money_to_his_account(): void
    {
        $user = User::factory()->create();

        $file = UploadedFile::fake()->image('check.jpg');

        $response = $this->actingAs($user)->post('/checks',
        [
            'description' => "Grandmas's Gift",
            'amount' => 30000,
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
        $user = User::factory()->create(['balance' => 10000]);

        $response = $this->actingAs($user)->post('/purchases',
        [
            'description' => "Grandmas's Gift",
            'amount' => 30000,
            'date' => Carbon::now(),
        ]);

        $response->assertStatus(302);

        $response = $this->actingAs($user)->post('/purchases',
        [
            'description' => "Grandmas's Gift",
            'amount' => 5000,
            'date' => Carbon::now(),
        ]);

        $response->assertStatus(201);
    }

    /**
     * An user can see a list of balance changes including time and description.
     */
    public function test_an_user_can_see_a_list_of_balance_changes(): void
    {
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
        $response->assertJsonFragment(['description' => 'T-shirt', 'amount' => $transactionOne->amount]);
        $response->assertJsonFragment(['description' => 'Groceries', 'amount' => $transactionTwo->amount]);
    }

}
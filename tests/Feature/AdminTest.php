<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Check;
use App\Enums\UserRole;
use App\Enums\CheckStatus;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /*
    * An admin can’t be also a customer
    */
    public function test_an_admin_can_not_be_also_a_customer(): void
    {
        $user = User::factory()->create(['role_id' => UserRole::ADMINISTRATOR]);

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(302);
    }

    /*
    * An admin can see a list of pending check deposit pictures with amount and picture and click to approve or deny the deposit.
    */
    public function test_an_admin_can_see_a_list_of_pending_check_deposit(): void
    {
        $this->withoutExceptionHandling();

        $admin = User::factory()->create(['role_id' => UserRole::ADMINISTRATOR]);
        $user = User::factory()->create(['role_id' => UserRole::CUSTOMER]);

        $checkOne = Check::factory()->create([
            'user_id' => $user,
            'status_id' => CheckStatus::ACCEPTED,
            'description' => 'May Payment',
            'amount' => 50,
        ]);

        $checkTwo = Check::factory()->create([
            'user_id' => $user,
            'status_id' => CheckStatus::ACCEPTED,
            'description' => 'June Payment',
            'amount' => 100,
        ]);

        $response = $this->actingAs($admin)->get('/admin/checks');

        $response->assertStatus(200);

        $response->assertSee($user->name);
        $response->assertSee('50.00');
        $response->assertSee('100.00');
    }


    /*
    * An admin can see a list of pending check deposit pictures with amount and picture and click to approve or deny the deposit.
    */
    public function test_when_a_check_is_approved_the_users_balance_is_increased(): void
    {
        $this->withoutExceptionHandling();

        $admin = User::factory()->create(['role_id' => UserRole::ADMINISTRATOR]);
        $user = User::factory()->create(['role_id' => UserRole::CUSTOMER, 'balance' => 10000]);

        $check = Check::factory()->create([
            'user_id' => $user,
            'description' => 'May Payment',
            'amount' => 10000,
        ]);

        $response = $this->actingAs($admin)->put('/admin/checks/accept/' . $check->id);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'balance' => 2000000
        ]);
    }
}

<?php

namespace Tests\Feature;

use App\Enums\CheckDepositStatus;
use App\Enums\UserRole;
use App\Models\Account;
use App\Models\CheckDeposit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /*
    * An admin can’t be also a customer
    */
    public function test_an_admin_can_not_be_also_a_customer(): void
    {
        $user = User::factory()->create(['role' => UserRole::ADMIN]);

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(302);
    }

    /*
    * An admin can see a list of pending check deposit pictures with amount and picture and click to approve or deny the deposit.
    */
    public function test_an_admin_can_see_a_list_of_pending_check_deposit(): void
    {
        $this->withoutExceptionHandling();

        $admin = User::factory()->create(['role' => UserRole::ADMIN]);
        $user = User::factory()->create(['role' => UserRole::CUSTOMER]);

        $checkOne = CheckDeposit::factory()->create([
            'user_id' => $user,
            'status' => CheckDepositStatus::APPROVED,
            'description' => 'May Payment',
            'amount' => 50,
        ]);

        $checkTwo = CheckDeposit::factory()->create([
            'user_id' => $user,
            'status' => CheckDepositStatus::APPROVED,
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

        $admin = User::factory()->create(['role' => UserRole::ADMIN]);
        $user = User::factory()->create(['role' => UserRole::CUSTOMER]);
        Account::factory()->create(['user_id' => $user->id, 'balance' => 10000]);

        $check = CheckDeposit::factory()->create([
            'user_id' => $user,
            'description' => 'May Payment',
            'amount' => 10000,
        ]);

        $response = $this->actingAs($admin)->put('/admin/checks/accept/'.$check->id);

        $response->assertStatus(200);

        $this->assertDatabaseHas('accounts', [
            'user_id' => $user->id,
            'balance' => 2000000,
        ]);
    }
}

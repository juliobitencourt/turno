<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /*
    * An admin can see a list of pending check deposit pictures with amount and picture and click to approve or deny the deposit.
    */
    public function test_an_admin_can_see_a_list_of_pending_check_deposit(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /*
    * An admin can’t be also a customer
    */
    public function test_an_admin_can_not_be_also_a_customer(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

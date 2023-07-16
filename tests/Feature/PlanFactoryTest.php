<?php

namespace Tests\Feature;

use App\Models\BronzePlan;
use App\Models\Client;
use App\Models\GoldPlan;
use App\Models\SilverPlan;
use App\Utilities\Factories\PlanFactory;
use App\Utilities\Interfaces\iPlan;
use Tests\TestCase;

class PlanFactoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_plan_factory(): void
    {
        $client = Client::FindOrFail('2');
        $planFactory = new PlanFactory();
        $plan = $planFactory->getPlan($client);

        $this->assertInstanceOf(GoldPlan::class, $plan);
    }
}

<?php

namespace App\Utilities\Factories;

use App\Models\BronzePlan;
use App\Models\Client;
use App\Models\GoldPlan;
use App\Models\SilverPlan;
use App\Utilities\Interfaces\iPlan;

class PlanFactory
{
    public function getPlan(Client $client): iPlan
    {

        return match (true) {
            $client->services()->count() == 1 =>  new SilverPlan(),
            $client->services()->count() > 1 =>  new GoldPlan(),
            default => new BronzePlan()
        };

    }
}

<?php

namespace App\Models;

use App\Utilities\Interfaces\iPlan;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class GoldPlan implements iPlan
{
    use HasFactory;

    private $discount = 10;

    public function getDiscount()
    {
        return $this->discount;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Utilities\Interfaces\iPlan;

class SilverPlan implements iPlan
{
    use HasFactory;

    private $discount = 5;

    public function getDiscount()
    {
        return $this->discount;
    }
}

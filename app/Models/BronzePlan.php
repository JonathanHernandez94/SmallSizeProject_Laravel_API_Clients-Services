<?php

namespace App\Models;

use App\Utilities\Interfaces\iPlan;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BronzePlan implements iPlan
{
    use HasFactory;

    private $discount = 0;

    public function getDiscount()
    {
        return $this->discount;
    }
}

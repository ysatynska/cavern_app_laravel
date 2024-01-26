<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topping extends Model
{
    use SoftDeletes;

    protected $table = "ysatynska_training.dbo.toppings_ys";
    protected $primaryKey = "id";
    protected $guarded = [];
    protected $dates = ['deleted_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condiment extends Model
{
    use SoftDeletes;

    protected $table = "ysatynska_training.dbo.condiments_ys";
    protected $primaryKey = "id";
}

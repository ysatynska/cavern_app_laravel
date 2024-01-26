<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use SoftDeletes;

    protected $table = "ysatynska_training.dbo.slide_ys";
    protected $primaryKey = "id";

    protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CondimentMap extends Model
{
    use SoftDeletes;

    protected $table = "ysatynska_training.dbo.condiments_map_ys";
    protected $primaryKey = "id";

    public function condiment() {
        return $this->hasOne(Condiment::class, 'id', 'fkey_condiment');
    }
    protected $guarded = [];
}

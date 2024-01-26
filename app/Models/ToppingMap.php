<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToppingMap extends Model
{
    use SoftDeletes;

    protected $table = "ysatynska_training.dbo.toppings_map_ys";
    protected $primaryKey = "id";

    public function topping() {
        return $this->hasOne(Topping::class, 'id', 'fkey_topping')->withTrashed();
    }
    protected $guarded = [];
}

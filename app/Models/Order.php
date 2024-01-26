<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Entree;

class Order extends Model
{
    use SoftDeletes;

    protected $table = "ysatynska_training.dbo.order_ys";
    protected $primaryKey = "id";

    public function entree() {
        return $this->hasOne(Entree::class, 'id', 'fkey_entree');
    }

    public function cheese() {
        return $this->hasOne(Cheese::class, 'id', 'fkey_cheese');
    }
    public function topping_maps() {
        return $this->hasMany(ToppingMap::class, 'fkey_order', 'id');
    }

    public function condiment_maps() {
        return $this->hasMany(CondimentMap::class, 'fkey_order', 'id');
    }
    // protected $guarded = [];
    protected $fillable = ['name', 'entree', 'cheese', 'fries', 'fkey_entree', 'fkey_cheese', 'fries', 'created_by', 'updated_by'];
    protected $dates = ['deleted_at'];
}

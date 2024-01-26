<?php

namespace App\Http\Controllers;
use App\Models\Topping;
use RCAuth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ToppingMap;

use Illuminate\Http\Request;

class ToppingController extends Controller
{
    use SoftDeletes;

    public function index() {
        return view('topping', [
            'toppings' => Topping::get()
        ]);
    }

    public function delete(Topping $topping) {
        $rcid = RCAuth::user()->rcid;
        $topping->deleted_by = $rcid;
        $topping->update();

        $topping->delete();

        return redirect()->action([ToppingController::class, 'index']);
    }

    public function addTopping(Request $request) {
        $validated = $request->validate([
            'topping_name' => ['required', 'string']
        ]);

        $rcid = RCAuth::user()->rcid;

        $topping = new Topping($validated);
        $topping->created_by = $rcid;
        $topping->updated_by = $rcid;

        $topping->save();

        return redirect()->action([ToppingController::class, 'index']);
    }

    public function __construct(){
        $side_navigation = [
            '<span class="far fa-home"></span> Home Page' => action([CavernController::class, 'index']),
            '<span class="far fa-list"></span> Order Form' => action([OrderController::class, 'orderForm'])
          ];

          view()->share('side_navigation', $side_navigation);
      }
}

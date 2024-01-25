<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RCAuth;
use Carbon\Carbon;
use App\Models\Topping;
use App\Models\Cheese;
use App\Models\Condiment;
use App\Models\Entree;
use App\Models\Order;
use App\Models\ToppingMap;
use App\Models\CondimentMap;

class OrderController extends Controller
{
    public function orderForm(){
        $toppings = Topping::get();
        $condiments = Condiment::get();
        $cheeses = Cheese::get();
        $entrees = Entree::get();

        return view('order', compact('toppings', 'condiments', 'cheeses', 'entrees'));
      }

    public function __construct(){
    $side_navigation = [
        '<span class="far fa-home"></span> Home Page' => action([CavernController::class, 'index']),
        '<span class="far fa-list"></span> Order Form' => action([OrderController::class, 'orderForm'])
        ];

        view()->share('side_navigation', $side_navigation);
    }

    public function storeOrder(Request $request){
        $validated = $request->validate([
            'entree_type' => ['required', 'string'],
            'name' => ['required', 'string', 'max:50'],
            'entree' => ['required', 'integer'],
            'cheese' => ['required', 'integer'],
            'fries' => ['required', 'string'],
            'toppings.*' => ['integer'],
            'condiments.*' => ['integer']
        ]);

        // $rcid = '12345';
        $rcid = RCAuth::user()->rcid;

        $order = new Order([
            'name' => $request->name,
            'fkey_entree' => $request->entree,
            'fkey_cheese' => $request->cheese,
            'fries' => ($request->fries == "yes" ? 1 : 0),
            'created_by' => $rcid,
            'updated_by' => $rcid
        ]);

        $order->save();

        if (!empty($request->toppings)){
            foreach($request->toppings as $key=>$topping){
                $topping_map = new ToppingMap([
                    'fkey_order' => $order->id,
                    'fkey_topping' => $topping,
                    'created_by' => $rcid,
                    'updated_by' => $rcid
                ]);

                $topping_map->save();
            }
        }

        if (!empty($request->condiments)){
            foreach($request->condiments as $key=>$condiment){
                $condiment_map = new CondimentMap([
                    'fkey_order' => $order->id,
                    'fkey_condiment' => $condiment,
                    'created_by' => $rcid,
                    'updated_by' => $rcid
                ]);

                $condiment_map->save();
            }
        }

        return redirect()->action([OrderController::class, 'thankYou'], ['order' => $order->name]);
    }

    public function thankYou(Order $order) {
        $useOrder = Order::with(['entree', 'cheese', 'topping_maps.topping', 'condiment_maps.condiment'])->find($order->id);

        return view('thankyou', ['order' => $useOrder]);
    }
}

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
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderController extends Controller
{
    use SoftDeletes;

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

        // $validated['created_by'] = $rcid;
        // $validated['updated_by'] = $rcid;

        // ddd($validated);
        // $order = new Order($validated);
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

    public function delete(Order $order) {
        $rcid = RCAuth::user()->rcid;
        $order->deleted_by = $rcid;
        $order->update();

        $order->delete();

        return redirect()->action([CavernController::class, 'allOrders']);
    }

    public function update(Order $order) {
        $toppings = Topping::get();
        $condiments = Condiment::get();
        $cheeses = Cheese::get();
        $entrees = Entree::get();

        $topping_ids = [];
        $condiment_ids = [];

        if(!is_null($order->condiment_maps)){
            foreach ($order->condiment_maps as $key => $obj) {
                $condiment_ids[] = $obj->fkey_condiment;
            }
        }
        if(!is_null($order->topping_maps)){
            foreach ($order->topping_maps as $key => $obj) {
                $topping_ids[] = $obj->fkey_topping;
            }
        }


        return view('updateOrder', compact('toppings', 'condiments', 'cheeses', 'entrees', 'order', 'condiment_ids', 'topping_ids'));
    }

    public function saveUpdatedOrder(Request $request, Order $order) {
        $validated = $request->validate([
            'entree_type' => ['required', 'string'],
            'name' => ['required', 'string', 'max:50'],
            'fkey_entree' => ['required', 'integer'],
            'fkey_cheese' => ['required', 'integer'],
            'fries' => ['required', 'string'],
            'toppings.*' => ['integer'],
            'condiments.*' => ['integer']
        ]);


        if ($validated['fries'] == 'no') {
            $validated['fries'] = 0;
        } else {
            $validated['fries'] = 1;
        }

        $rcid = RCAuth::user()->rcid;

        $order->created_by = $rcid;
        $order->updated_by = $rcid;
        $order->update($validated);


        $topping_ids = [];
        $condiment_ids = [];

        if(!is_null($order->condiment_maps)){
            foreach ($order->condiment_maps as $key => $obj) {
                $condiment_ids[] = $obj->fkey_condiment;
            }
        }
        if(!is_null($order->topping_maps)){
            foreach ($order->topping_maps as $key => $obj) {
                $topping_ids[] = $obj->fkey_topping;
            }
        }


        if($request->toppings !== null && !empty(array_diff($topping_ids, $request->toppings))){
            foreach(array_diff($topping_ids, $request->toppings) as $key=>$topp){
                $topping_map = ToppingMap::where('fkey_order', $order->id)
                                            ->where('fkey_topping', $topp)
                                            ->first();
                if ($topping_map !== null){
                    $topping_map->deleted_by = $rcid;
                    $topping_map->update();
                    $topping_map->delete();
                }
            }
        }

        if ($request->toppings !== null && !empty(array_diff($request->toppings, $topping_ids))) {
            foreach(array_diff($request->toppings, $topping_ids) as $key=>$topping){
                $topping_map = new ToppingMap([
                    'fkey_order' => $order->id,
                    'fkey_topping' => $topping,
                    'created_by' => $rcid,
                    'updated_by' => $rcid
                ]);

                $topping_map->save();
            }
        }

        if($request->condiments !== null && !empty(array_diff($condiment_ids, $request->condiments))){
            foreach(array_diff($condiment_ids, $request->condiments) as $key=>$cond){
                $condiment_map = CondimentMap::where('fkey_order', $order->id)
                                            ->where('fkey_condiment', $cond)
                                            ->first();
                if ($condiment_map !== null){
                    $condiment_map->deleted_by = $rcid;
                    $condiment_map->update();
                    $condiment_map->delete();
                }
            }
        }

        if ($request->condiments !== null && !empty(array_diff($request->condiments, $condiment_ids))) {
            foreach(array_diff($request->condiments, $condiment_ids) as $key=>$condiment){
                $condiment_map = new CondimentMap([
                    'fkey_order' => $order->id,
                    'fkey_condiment' => $condiment,
                    'created_by' => $rcid,
                    'updated_by' => $rcid
                ]);

                $condiment_map->save();
            }
        }

        return redirect()->action([CavernController::class, 'allOrders']);
    }
}

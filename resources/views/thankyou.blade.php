@extends('template')
@section('title')
    Order Complete!
@endsection

@section('page_title')
    The Cavern
@endsection

@section('heading')
  at <a href="https://www.roanoke.edu">Roanoke College</a>
@endsection


@section('stylesheets')
    <link rel="stylesheet" href="{{asset('styleThankYou.css')}}">
@endsection

@section('content')

<html>

<body>
    <div id="orderThankYou">
    <h4> Thank You For Your Order! </h4>
    <table>
      <tbody>
        <tr>
          <td class="bold">Name</td>
          <td>{{$order->name}}</td>
        </tr>
        <tr>
          <td class="bold"> Entree </td>
          <td> {{$order->entree->entree_name}} </td>
        </tr>
        <tr>
          <td class="bold"> Cheese </td>
          <td> {{$order->cheese->cheese_name}} </td>
        </tr>
        <tr>
          <td class="bold"> Toppings </td>
          <td>
            @forelse ($order->topping_maps as $topping)
                {{$topping->topping->topping_name}}
                <br>
            @empty
                No Toppings
            @endforelse
         </td>
        </tr>
        <tr>
          <td class="bold"> Condiments </td>
          <td>
            @forelse ($order->condiment_maps as $condiment)
                {{$condiment->condiment->condiment_name}}
                <br>
            @empty
                No Condiments
            @endforelse
            </td>
        </tr>
        <tr>
          <td class="bold"> Fries </td>
          <td> {{($order->fries) ? "Yes" : "No"}} </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
@endsection

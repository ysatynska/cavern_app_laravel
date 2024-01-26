@extends('template')
@section('title')
    Liz's Cavern Order App
@endsection

@section('page_title')
    The Cavern
@endsection

@section('heading')
  Order Form
@endsection

@section('stylesheets')
    <link rel="stylesheet" href="{{asset('style.css')}}">
@endsection

@section('content')
<html>
<head>
  <title> Cavern Order: Roanoke College </title>
  <link media="all" type="text/css" rel="stylesheet" href="https://blackstone.roanoke.edu/michael/laravel5-template/resources/assets/sass/main.scss">
  <link media="all" type="text/css" rel="stylesheet" href="https://blackstone.roanoke.edu/michael/laravel5-template/resources/assets/sass/_grid.scss">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div class="bodyBox">
    <div class="main">
        {{-- {{ddd( ($condiment_ids[0]))}} --}}
      <form class = "container" method="POST" action="{{ action([App\Http\Controllers\OrderController::class, 'saveUpdatedOrder'], ['order' => $order]) }}" autocomplete="on">
        @csrf
        <div class="row py-4 px-5">
          <div id="type" class="col-lg-12 col-md-12 col-sm-12 form-check">
            <label> Type
              <br>
              <label><input name="entree_type" type="radio" value="Burger or Sandwich" required {{$order->entree->entree_type == "Burger or Sandwich" ? "checked":''}}> Burger or Sandwich </label>
              <br>
              <label><input name="entree_type" type="radio" value="Wrap" required {{$order->entree->entree_type == "Wrap" ? "checked":''}}> Wrap </label>
            </label>
          </div>
        </div>

        <div class="orderForm" style="visibility: hidden">
          <div class="row p-5 pb-5 px-5">

            <div id="name" class="col-lg-6 col-md-6 col-sm-12">
              <label class="form-label" for="namee"> Name:  </label>
              <input type="text" class="form-control" name="name" value="{{$order->name}}" id="{{$order->name}}" required>
            </div>

            <div id="entree" class="col-lg-6 col-md-6 col-sm-12" required>
              <label for="dropMenu"> Entree </label>
              <br>
              <select class = "form-select own" name ="fkey_entree" id="dropMenu" required>
                @foreach ($entrees as $key => $entree)
                    <option
                        class="{{$entree->entree_type}}"
                        value="{{ $entree->id}}"
                        {{$order->entree == $entree ? "selected":''}}>
                        {{ ucwords($entree->entree_name)}}
                    </option>
                @endforeach
              </select>
            </div>
          </div>

          <hr>
          <div class="row py-5 px-5 align-items-end">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="form-check">
                    <label> Condiments </label>
                    <br>
                    @foreach ($condiments as $key=>$condiment)
                        <label>
                            <input type="checkbox"
                            value="{{$condiment->id}}"
                            name="condiments[]"
                            {{in_array($condiment->id, $condiment_ids) == true ? "checked":''}}
                            > {{$condiment->condiment_name}}
                        </label>
                        <br>

                        @if ($loop->iteration%($loop->count/3) === 0)
                            </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-check">
                        @endif
                    @endforeach
                </div>
            </div>
          </div>

          <hr>

          <div class="row py-5 px-5">
            <div class="col-lg-6 col-md-6 col-sm-12">

                <div class="form-check">
                  <label> Toppings
                    @foreach ($toppings as $key=>$topping)
                        <br>
                        <label><input type="checkbox" name="toppings[]" value="{{$topping->id}}" {{in_array($topping->id, $topping_ids) ? "checked":''}}> {{$topping->topping_name}} </label>
                    @endforeach
                  </label>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="row">
                <div id="cheese" class="form-check">
                  <label> Cheese
                    @foreach ($cheeses as $key=>$cheese)
                        <br>
                        <label>
                            <input type="radio" name="fkey_cheese" value="{{$cheese->id}}" required {{$order->fkey_cheese == $cheese->id ? "checked":''}}>
                            {{$cheese->cheese_name}}
                        </label>
                    @endforeach
                  </label>
                </div>
              </div>


              <div class="row">
                <div id="fries" class="form-check">
                  <label class = "fries"> Fries
                    <br>
                    <label> <input type="radio" name="fries" value ="yes" required {{$order->fries ? "checked":''}}> Yes </label>
                    <br>
                    <label> <input type="radio" name="fries" value ="no" required {{$order->fries ? "":'checked'}}> No </label>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <hr>

          <div class="row py-4">
            <div class= "col-lg-12 col-md-12 col-sm-12 justify-content-flex-end align-items-center">
              <div id="submit">
                <input type="submit" class="btn btn-outline-primary btn-lg" value="Submit Order">
              </div>
            </div>
          </div>
          <hr>
        </div>
      </form>
    </div>


    @section('javascript')
        <script src="{{asset('app.js')}}"> </script>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </div>
</body>
</html>
@endsection

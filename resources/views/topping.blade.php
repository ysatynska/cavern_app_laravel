@extends('template')
@section('title')
    Liz's Cavern App
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
    <h4> Edit Toppings </h4>
    <table>
      <tbody>
        <tr>
            <td colspan="2">

                <form method="POST" action="{{ action([App\Http\Controllers\ToppingController::class, 'addTopping']) }}">
                    @csrf

                    <div class="grid-2" style="align-items: end">

                        <div class="grid-item">
                            <label class="form-label" for="topp" style="color:#2f7951; font-size: 19px"> Add Topping </label>
                                <input type="text" class="form-control" name="topping_name" id="topp" required>
                        </div>

                        <div class="grid-item" style="justify-self: end">
                            <input type="submit" class="btn-success" value="Add Topping">
                        </div>
                </form>

            </td>
        </tr>
        @foreach ($toppings as $topping)

            <tr>
                <td>{{$topping->topping_name}}</td>

                <td><button class="btn-danger"
                    onclick = "location.href =
                    '{{ action([App\Http\Controllers\ToppingController::class, 'delete'], ['topping' => $topping]) }}'"
                    name="delete" value="Delete" style="float: right"> Delete Topping
                </button>
                </td>
            </tr>

        @endforeach
      </tbody>
    </table>
</html>
@endsection

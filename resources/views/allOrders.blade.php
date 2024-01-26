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
    <div id="allOrders">
    <h4> All Orders </h4>
    <table>
        <thead>
            <tr>
              <th scope="col" class="bold">Name </th>
              <th scope="col" class="bold">Time Placed </th>
              <th scope="col" class="bold">Manage Order </th>
            </tr>
          </thead>
      <tbody>

        @foreach ($orders as $order)

        <tr>
          <td>{{$order->name}}</td>
          <td>{{$order->created_at->format('n/j/Y g:m a')}}</td>

          <td><button class="btn-success"
                onclick = "location.href =
                '{{ action([App\Http\Controllers\OrderController::class, 'thankYou'], ['order' => $order, 'number' => $order->id]) }}'"
                name="review" value="Review"> Review
            </button>

            <button class="btn-danger"
                onclick = "location.href =
                '{{ action([App\Http\Controllers\OrderController::class, 'delete'], ['order' => $order]) }}'"
                name="delete" value="Delete"> Delete
            </button>

            <button class="btn-primary"
                onclick = "location.href =
                '{{ action([App\Http\Controllers\OrderController::class, 'update'], ['order' => $order]) }}'"
                name="edit" value="Edit"> Edit
            </button>
            </td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
</body>
</html>
@endsection

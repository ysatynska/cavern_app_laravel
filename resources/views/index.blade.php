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
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link media="all" type="text/css" rel="stylesheet" href="https://blackstone.roanoke.edu/michael/laravel5-template/resources/assets/sass/_grid.scss">
    <link media="all" type="text/css" rel="stylesheet" href="https://blackstone.roanoke.edu/michael/laravel5-template/resources/assets/sass/main.scss">
@endsection

@section('content')

<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/fb391f6bfc.js" crossorigin="anonymous"></script>
    <body>
    <div class="bodyBox">
      <div class="grid">
        <div class="grid-2">
          <div id="media" class="grid-item">
            <img src="{{asset('Captures/Capture.jpg')}}" alt="Cafeteria"/>
          </div>
          <div class="text grid-item">
            <h2>Eat and Run!</h2>
            <p>The Cavern, our "grab and go" eatery located on the lower level of the Colket Center, is operated by RC Dining Services. Guests can purchase drinks,
              burgers, salads, wraps, subs, etc., or use the meal plan to obtain lunch or dinner Monday through Friday from 11:00 am to 11:00 pm and Saturday evenings from 5:00 pm to 11:00 pm.
              "Trade Meals" are designed as meal equivalents for those on the meal plan.</p>
              <p> The Cavern also offers staging, lighting and sound systems to accommodate dances, karaoke, bingo, poetry
              readings and any other events organized by the college community.</p>
              <div id="buttons">


                <button id="imp" onclick = "location.href = 'https://www.roanoke.edu/inside/a-z_index/dining_services/the_cavern/cavern_menu'" name="view_menu" value="View Menu"> <i class="fa-regular fa-file-lines"></i> View Menu</button>
                <button id="imp" onclick = "location.href = '{{ action([App\Http\Controllers\OrderController::class, 'orderForm']) }}'" name="place_order" value="Place Order"> <i class="fa-sharp fa-solid fa-share"></i> Place Order</button>
                <!-- <input type="button" onclick = "location.href = 'https://www.roanoke.edu/inside/a-z_index/dining_services/the_cavern/cavern_menu'" name="view_menu" value="View Menu">
                <input type="button" onclick = "location.href = 'https://blackstone.roanoke.edu/liz/cavern_app/order.html'"name="place_order" value="Place Order"> -->
              </div>
          </div>
          <div id="tableBox" class="grid-item">
            <div id="hours">
              <h4> Cavern Hours </h4>
              <table>
                <thead>
                  <tr>
                    <th scope="col">Day </th>
                    <th scope="col">Hours </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Monday</td>
                    <td>11:00 am to 11:00 pm</td>
                  </tr>
                  <tr>
                    <td> Tuesday </td>
                    <td> 11:00 am to 11:00 pm </td>
                  </tr>
                  <tr>
                    <td> Wednesday </td>
                    <td> 11:00 am to 11:00 pm </td>
                  </tr>
                  <tr>
                    <td> Thursday </td>
                    <td> 11:00 am to 11:00 pm </td>
                  </tr>
                  <tr>
                    <td> Friday </td>
                    <td> 11:00 am to 11:00 pm </td>
                  </tr>
                  <tr>
                    <td> Saturday </td>
                    <td> 5 pm to 11 pm </td>
                  </tr>
                  <tr>
                    <td class = "sat" colspan="2">Closed Saturday <button id="imp" onclick = "location.href = '{{asset('secret_base')}}'" name="view_menu" value="View Menu"> </button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div id="media" class="grid-item">
            <img src="{{asset('Captures/Capture2.jpg')}}"  alt="Cafeteria"/>
          </div>
        </div>
      </div>
  </div>
  </body>
</html>
@endsection

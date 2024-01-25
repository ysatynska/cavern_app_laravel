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
    <link rel="stylesheet" href="{{asset('styleThankYou.css')}}">
@endsection

@section('content')
<html>
    <h4> You got to the secret base :) <h4>
        <form method="POST" action="{{ action([App\Http\Controllers\CavernController::class, 'secretBaseFileUpload']) }}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="form-control" name="file" accept=".jpg"></input>
            <input type="submit" class="btn btn-outline-primary btn-lg" value="Submit File">
        </form>

        @if(!empty($slides))
        <div class="grid-1">
            @foreach ($slides as $key => $slide)
            <div class="grid-item image" id="{{$key}}" style="display:none">
                <img src="{{ action([App\Http\Controllers\CavernController::class,
                                        'secretBaseFileRetrieve'], ['id' => $slide->id])}}"></img>
            </div>
            @endforeach
        </div>
        @endif

        <button id="imp" onclick = "location.href = '{{ action([App\Http\Controllers\CavernController::class, 'secretBaseFileNewest']) }}'" name="most_recent" value="download"> Download Recent</button>
    @section('javascript')
        <script>
            let currImage = document.getElementById("1");
            let oldImage = document.getElementById("0");
            let currId = 1;

            if(oldImage !== null) {
                oldImage.style.display = "initial";

                if (currImage !== null) {
                    setInterval(() => {
                        oldImage.style.display = "none";
                        currImage.style.display = "initial";

                        oldImage = currImage;
                        currImage = document.getElementById(currId);

                        if(currImage === null){
                            currId = 0;
                            currImage = document.getElementById(currId);

                        } else {
                            currId++;
                        }
                        console.log("going")
                    }, 3000);
                }
            }
        </script>
    @endsection
</html>
@endsection

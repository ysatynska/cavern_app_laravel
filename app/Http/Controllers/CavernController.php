<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RCAuth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Slide;

class CavernController extends Controller
{
  public function index(){
    return view('index');
  }

  public function __construct(){
    $side_navigation = [
        '<span class="far fa-home"></span> Home Page' => action([CavernController::class, 'index']),
        '<span class="far fa-list"></span> Order Form' => action([OrderController::class, 'orderForm'])
      ];

      view()->share('side_navigation', $side_navigation);
  }

  public function secretBase(){
    return view('secretbase', [
        'slides' => Slide::get()
    ]);
  }

  public function secretBaseFileUpload(Request $request) {
    $slide = new Slide([
        'filename'=> $request->file('file')->store('storage\app\secret'),
    ]);

    $slide->save();

    return redirect()->action([CavernController::class, 'secretBase']);
  }

  public function secretBaseFileRetrieve($id) {
    $slide = Slide::find($id);
    $file = Storage::get($slide->filename);

    return response($file)->header('Content-type', 'image/jpg');
  }

  public function secretBaseFileNewest() {
    $file = Slide::orderBy('created_at', 'desc')->first();
    return Storage::download($file->filename, 'newest');
  }
}

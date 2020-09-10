<?php
use App\Service;
use App\Post;
use Illuminate\Http\Request;
use App\Funding;
use Carbon\Carbon;


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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/chat',function (){
    return view('chating');
});
Route::get('/home','HomeController@index')->name('home');

Route::get('/services', 'HomeController@index')->name('services');
Route::get('/dakishs', 'HomeController@index')->name('dakishs');
Route::get('/redos', 'HomeController@index')->name('redos');
Route::get('/asks', 'HomeController@asks')->name('asks');
Route::get('/chats', 'HomeController@chats')->name('chats');
Route::get('/orders', 'HomeController@orders')->name('orders');
Route::get('/saved', 'HomeController@saves')->name('saved');
Route::get('/messages/&{id}', 'HomeController@messages')->name('messages');

Route::get('/profile/{id}','HomeController@ShowUserProfile')->name('profile');
Route::get('/information',function(){
    return view('profile.createProfile');
});
Route::get('/editProfile',function(){
    return view('profile.editProfile')->with('message','none');
})->name('editProfile');

Route::post('/updateProfile','HomeController@updateProfile');
Route::post('/getinformation','HomeController@getinformation');

Route::get('/post/show/&{id}/&{type}',function($id,$type){
    $post = Post::find($id);
    $post->viewCount +=1 ;
    $post->save();
    return view('showPost',compact('id','type'));
})->name('showPost');

Route::get('/funding', function(){
    // $fund = Funding::all()->sortByDesc('created_at')->take(1);
    $fund = Funding::all()->last();
    if($fund !== null && $fund->fund_date > Carbon::now()){
        $msg = 'نحنا مضطرين نأجل تمويلك شوي لانو لسا في حملة جمع شغالة';
    } else {
        $msg = 'فيك تطلب تمويل';
    }
    
    return view('extra.funding',compact('msg'));
})->name('funding');

Route::get('/setting',function(){
    return view('setting');
})->name('setting');

Route::get('/setLang/{lang}',function($lang){
    // dd(session()->get('locale'));
    App::setLocale($lang);
        session()->put('lang', $lang);
        return redirect()->back();
});
 
Route::post('/upload/image','HomeController@uploadDakishImage');
Route::post('/getFunding','HomeController@uploadFunding');

Route::get('/about',function(){
    return view('extra.about');
});

Route::post('/sendMsg','HomeController@sendMsg');

Auth::routes();

Route::get('/cookie',function(Request $req){
    $response = new Illuminate\Http\Response('Hello World');
    $response->withCookie(cookie('name', 'value', 5));
    $value = $req->cookie();
    dd($value,$response);
});

Route::get('/intruder', function(){
    return view('intruder');
})->name('intruder');

Route::get('/{any}',function(){
    return back();
});



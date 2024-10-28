1) composer require beyondcode/laravel-websockets -w
2)php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="migrations"
3)php artisan migrate
4) php artisan vendor:publish --provider="BeyondCode\LaravelWebSockets\WebSocketsServiceProvider" --tag="config"  

5)Go to config/broadcasting.php and doi chnage like this remove pusher and set the 
   'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                // 'host' => env('PUSHER_HOST') ?: 'api-'.env('PUSHER_APP_CLUSTER', 'mt1').'.pusher.com',
                'host' => '127.0.0.1',
                // 'port' => env('PUSHER_PORT', 443),
                'port' =>6001,
                // 'scheme' => env('PUSHER_SCHEME', 'https'),
                'scheme' => 'http',
                // 'encrypted' => true,
                // 'useTLS' => env('PUSHER_SCHEME', 'https') === 'https',
                'useTLS' => true,
            ],
            'client_options' => [
                // Guzzle client options: https://docs.guzzlephp.org/en/stable/request-options.html
            ],
        ],

6) now go to the app.php and config/app.php
and heere uncomment the   App\Providers\BroadcastServiceProvider::class,

7)IN CHANGE THE ENV FILE
BROADCAST_DRIVER=pusher



PUSHER_APP_ID=123123123
PUSHER_APP_KEY=asdfsdsdfmsd
PUSHER_APP_SECRET=fsdfdfhsdhgjb
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

6) now again strat the websocket server php artisan websocket:server
7) make an event using this php artisan make:event chat
and here changes 


class chat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $username;
    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct($username,$message)
    {
        //
        $this->username=$username;
        $this->message=$message;
    }




       public function broadcastOn()
    {
        // return [
        //     new PrivateChannel('channel-name'),
        // ];
        return new Channel('channel-name');
    }
}


8) Then Test the the function is working or not USE tinker
using this command php artisan tinker and  event(new \App\Events\chat('Akash Kumar','Hii this is Akash this side'))

9) make a blad file or write code on welcome file 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat App Login</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">
        <div class="text-center">
            Welcome To The Chat App
        </div>

        <button onclick="fireEvent()">Fire Event</button>
    </div>
    


    <script>
        function fireEvent(){

            $.ajax({
                'headers':{
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                },
                url:"{{route('broadCast.chat')}}",
                type:'POST',
                success: function(data){
                    console.log(data);
                    
                }
            })
        }
    </script>
</body>
</html>


10) In chat OCntroler and web.php u have to do little changes 
<?php

namespace App\Http\Controllers;

use App\Events\chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    //

    public function index(){
        return view('welcome');
    }

    public function broadCastChat(){
        event(new chat("Akash Kumar","Hii,Akash this side"));
        return response()->json(['msg'=>'event has been fired !!']);
    }
}


<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('',[ChatController::class,'index'])->name('user.login');
Route::post('/broadCast',[ChatController::class,'broadCastChat'])->name('broadCast.chat');



11) Run the command npm install
12 npm install laravel-echo pusher-js


13 in resources\js\bootstrap.js do chnages 
import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: window.location.hostname,
    wsPort: 6001,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: false,
    disableState:true
});


14) in termnal npm run dev


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Links;
use App\User ;
use App\Post ;
use App\Chat ;
use App\Search ;
use App\Ask ;
use App\Setting;
use App\Funding;
use App\Message;
use Auth;
use App\Http\Livewire\Funding as Fund;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){                  
        $type = 'feeds';
        $check = User::find(Auth::user()->id);
        if($check->phone == 'notset' && $check->rate == 5 )
        {
            // $first = true;
            // return view('home',compact('first','type'));
            return redirect('/information');
        } else {
            return view('home' , compact('type'));
        }
    }

    public function showUserProfile($id){
        $user = User::find($id);
        $setting = Setting::find($user->setting_id);
        $link1 = Links::where('first',Auth::user()->id)->where('second',$id)->first();
        $link2 = Links::where('first',$id)->where('second',Auth::user()->id)->first();
        // dd($link1,$link2);
        if($link1 !== null || $link2 !== null)
            {$setting->links = true;}
        return view('profile.profile',compact('id','setting','user'));
    }

    public function getinformation(Request $req ){
        
        $set = Setting::find(Auth::user()->setting_id);
        $set->user_id = Auth::user()->id;
        $set->save();

        $date = Carbon::now();
        $date->subYear(13);
        $this->validate($req,[
            'first_name'=>'required|alpha',
            'last_name'=>'required|string',
            'age'=>'required',
            'gender'=>'required',
            'phone'=>'required|numeric',
            'city'=>'required|string',
            'area'=>'required|string',
            'full_address'=>'required|string',
            'bio'=>'required|string',
            'profile_picture' => 'nullable|image|max:1999',
        ]);

        // dd($req->all());

        $image = $req->file('profile_picture');
        if($req->hasFile('profile_picture') && $image->isFile()){
            $nameWithExt = $image->getClientOriginalName();
            $fileName = pathinfo($nameWithExt,PATHINFO_FILENAME);
            $ext = $image->getClientOriginalExtension();
            $currentDate = Carbon::now()->toDateString();            
            $nameToStore = $fileName.'_'.$currentDate.'.'.$ext;
            if(!Storage::disk('public')->exists('users_images')){
                Storage::disk('public')->makeDirectory('users_images');
            }
            $path = $image->storeAs('public/users_images',$nameToStore);
        }else{
            $nameToStore = 'default_picture.jpg';
        } 
        
        $set = User::find(Auth::id());
        $set->firstName = $req->first_name;
        $set->lastName = $req->last_name;
        $set->age = $req->age;
        $set->gender = $req->gender;
        $set->phone = $req->phone;
        $set->address = $req->city.'-'.$req->area.'-'.$req->full_address;
        $set->image = $nameToStore;
        $set->about = $req->bio;
        $set->save();

        $inde = new Search();
        $inde->setIndex($req->bio,Auth::user()->name,'user',Auth::user()->id);
        return redirect()->route('home');
    }

    public function updateProfile(Request $req){
        $get = $req->all();
        // dd($get);
        $info = array_splice($get,0,-1);
        $address = explode("-",$info["address"]);
        $city = $address[0];
        $area = $address[1];
        $full = array_splice($address,2,2);
        $full1 = implode("-",$full);
        $image = $req->file('profile_picture');
        if($req->hasFile('profile_picture') && $image->isFile()){
            $nameWithExt = $image->getClientOriginalName();
            $fileName = pathinfo($nameWithExt,PATHINFO_FILENAME);
            $ext = $image->getClientOriginalExtension();
            $currentDate = Carbon::now()->toDateString();            
            $nameToStore = $fileName.'_'.$currentDate.'.'.$ext;
            if(!Storage::disk('public')->exists('users_images')){
                Storage::disk('public')->makeDirectory('users_images');
            }
            $path = $image->storeAs('public/users_images',$nameToStore);
        }else{
            $nameToStore = Auth::user()->image;
        } 
        $user = User::find(Auth::user()->id);
        $user->firstName = $info["first_name"];
        $user->lastName = $info["last_name"];
        $user->age = $info["age"];
        $user->phone = $info["phone"];
        $user->address = $city.'-'.$area.'-'.$full1;
        $user->about = $info["bio"];
        $user->image = $nameToStore;
        $user->save();
        return back()->with('message','success');
        // dd($get,$info,$city,$area,$full1);
    }

    public function asks(){
        $type = 'asks';
        return view('home',compact('type'));
    }

    public function orders(){
        $type = 'orders';
        return view('home',compact('type'));
    }

    public function saves(){
        $type = 'saves';
        return view('home',compact('type'));
    }

    public function chats(){
        $type = 'chats';
        return view('home',compact('type'));
    }

    public function messages($id){
        $chat = Chat::find($id);
        if(null == $chat){return redirect()->route('intruder');}
        $uid=Auth::user()->id;
        // dd($uid,$chat->firstPart,$chat->secondPart);
        if($uid !== $chat->firstPart && $uid !== $chat->secondPart){
            return redirect()->route('intruder');
        }else{
            $type = 'messages';
            $id = $id;
            return view('home',compact('type','id')); 
        }
        
    }

    public function displayAsk($id){
        // $type = 'asks';
        // $askid = $id;
        // return view('home',compact('type','askid'));
    }

    public function uploadDakishImage(Request $req){

        
        $this->validate($req,[
            'id'=>'required',
            'item_image.*'=>'image|nullable|max:1999',
        ]);
        $id = $req->id;
        // $image = $req->item_image;
        // dd($id,$image);
        $file =[];
        if($req->hasFile('item_image')){
            foreach($req->file('item_image') as $image)
            {
                $nameWithExt = $image->getClientOriginalName();
                $fileName = pathinfo($nameWithExt,PATHINFO_FILENAME);
                $ext = $image->getClientOriginalExtension();
                $currentDate = Carbon::now()->toDateString();            
                $nameToStore = $fileName.'_'.$currentDate.'.'.$ext;
                if(!Storage::disk('public')->exists('dakish_items')){
                    Storage::disk('public')->makeDirectory('dakish_items');
                }
                $path = $image->storeAs('public/dakish_items',$nameToStore);
                $file[]= $nameToStore;
            } 
            $post = Post::find($id);
            $post->file = $file;
            $post->save();   
        }else{
            $nameToStore = 'nofile';
        }
        return redirect()->route('home');
    }

    public function uploadFunding(Request $req)
    {
        $all = $req->all();
        $info = array_splice($all,0,-1);
        Funding::storeFund($info);
        return redirect()->route('home');
    }

    public function sendMSg(Request $req){
        $data = $req->all();
        if($data[0] == null){
            return \response()->json('empty MSg');  
        } else {
            $msg = new Message();
            $msg->chat_id = 'HalpakChat';
            $msg->source = 'About';
            $msg->sender_id = Auth::user()->id;
            $msg->Reciver_id = 'Helpak';
            $msg->message = $data[0];
            $msg->status = 'waiting';
            $msg->viewed = 0;
            $msg->save();
        } 
        return response()->json('done');       
    }

}

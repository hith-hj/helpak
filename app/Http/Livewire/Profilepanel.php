<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Setting;
use App\Likes;
use App\Redos;
use App\Links;
use App\User;
use App\Post;
use App\Rate;
use App\Ask;
use Auth;
use DB;
use App\Chat;
use App\Message;
use App\Notification;

class Profilepanel extends Component
{
    public $user_id; 
    public $message;
    public $msgContent;
    public $allowedRate,$nextTimeToAllow;
    protected $userPosts;
    protected $infos;

    public function mount($id){
        $this->user_id = $id;
        $this->infos = User::find($id);
        $this->infos->asks = Ask::all()->where('reciver_id',$id)->count();
        $this->infos->redos = Redos::all()->where('post_user_id',$id)->count();
        $this->infos->links = DB::table('links')->where('first',$id)->orWhere('second',$id)->count();
        $this->infos->setting = Setting::find($this->infos->setting_id);
        $rates = Rate::all()->where('rated_user_id',$this->user_id)->where('rated_by_id',Auth::user()->id)->first();
        if($rates == null || $rates->nextDateToAllowe < Carbon::now()){
            $this->infos->allowedRate = true;
        }else{
            $this->infos->nextDateToAllow = $rates->nextDateToAllowe;
        }
        $posts = Post::all()->where('user_id',$id);
        foreach($posts as $post ){
            $this->infos->likes += Likes::all()->where('post_id',$post->id)->count();
        }
        // dd($this->infos);
    }

    public function rateUser(){
        $id = $this->user_id;
        $rates = Rate::all()->where('rated_user_id',$id)->where('rated_by_id',Auth::user()->id)->last();
        if(null != $rates && $rates->nextDateToAllowe > Carbon::now()){
            $rates->rateCount +=1;
            $rates->nextDateToAllowe = Carbon::now()->add('7 days');
            $rates->save();
        }else{
            $rate = new Rate();
            $rate->rated_user_id = $id;
            $rate->rated_by_id = Auth::user()->id;
            $rate->rateCount += 1;
            $rate->nextDateToAllowe = Carbon::now()->add('7 days');
            $rate->save();
        }        
        $user = User::find($id);
        $user->rate +=25;
        $user->save();
        $this->setLink($id,'profile','user','rate');
        $noti = new Notification();  
        $noti->add(Auth::user()->id,$id,$id,'rate','you got rated by');        
        $this->emit('userRated');
        // dd($user); 
    }

    public function sendMessagezzz(){
        // dd($this->user_id,$this->msgContent);
        $chat1 = Chat::where('firstPart',$this->user_id)->where('secondPart',Auth::user()->id)->first();
        $chat2 = Chat::where('firstPart',Auth::user()->id)->where('secondPart',$this->user_id)->first();
        $chats = [$chat1,$chat2];
        $chatid = array_filter($chats,function($colec){return $colec != null ;});
        // dd(json_encode($chat));
        // dd($chatid[0]->id);
        $msg = new Messages();
        $msg->chat_id = $chat[0]->id;
        $msg->sender_id = Auth::user()->id;
        $msg->reciver_id = $this->user_id;
        $msg->content = $this->msgContent;
        $msg->save();
        $chat = Chat::find($chatid[0]->id);
        $chat->msgCount += 1;
        $chat->save();
    }

    public function sendMessage(){
        $link1 = Links::where('first',Auth::id())->where('second',$this->user_id)->first();
        $link2 = Links::where('first',$this->user_id)->where('second',Auth::id())->first();
        if($link1 == null && $link2 ==  null){
            $this->msgContent = 'No links , you can not send message';
            $this->message = '';
        }else{
            $chat1 = Chat::where('firstPart',$this->user_id)->where('secondPart',Auth::user()->id)->first();
            $chat2 = Chat::where('firstPart',Auth::user()->id)->where('secondPart',$this->user_id)->first();
            if(empty($chat1) && empty($chat2) ){
            $chat = new Chat();
                $chat->firstPart = Auth::user()->id;
                $chat->secondPart = $this->user_id;
                $chat->save(); 
                $chatId = $chat->id;
            } else{
                if($chat1===null){$chatId =  $chat2->id; }
                else{$chatId = $chat1->id;}
            }
            if(strlen($this->msgContent)>0) {     
            $msg = new Message();
            $msg->chat_id = $chatId;
            $msg->source = 'post';
            $msg->sender_id = Auth::user()->id;
            $msg->Reciver_id = $this->user_id;
            $msg->message = $this->msgContent;
            $msg->status = 'waiting';
            $msg->viewed = 0;
            $msg->save();
            $chats = Chat::find($chatId);
            $chats->msgsCount +=1;
            $chats->save();
            $this->emit('messageSent');
            $noti = new Notification();  
            $noti->add(Auth::user()->id,$this->user_id,$chatId,'message',$this->msgContent);
            $this->setLink($this->user_id,'profile','user','message');  
            $this->msgContent = '';
            $this->message = '';}
        }        
    }

    public function setLink($id,$post_id,$type,$lType){
        $first = Links::all()->where('first',$id)->where('second',Auth::user()->id)->first();
        if(!empty($first)){
            $first->rate += 1;
            $first->link_on .=', '.$post_id; 
            $first->link_type .=', '.$lType; 
            $first->post_type .=', '.$type; 
            $first->save();            
        }else{
            Links::create([
                'first'=>$id ,
                'second'=>Auth::user()->id,
                'link_on'=>$post_id,
                'link_type'=>$lType,
                'post_type'=>$type,
                'rate'=>0,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.profilepanel',['info' => $this->infos]);
    }
}

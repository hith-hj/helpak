<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Message;
use App\User;
use App\Post;
use App;
use Auth;
use DB;

class Subchat extends Component
{
    protected $chats;
    protected $firstPart;
    public $user_id;

    public function mount($id){
        // dd($id);
        $this->user_id = $id;
    }
    public function getChats($id){
        $chats = DB::table('chats')->where('firstPart', $id)->orWhere('secondPart', $id)->where('status','<>','erased')->latest('updated_at')->get();
        foreach($chats as $chat){
            $msgs = Message::all()->where('chat_id',$chat->id)->sortByDesc('created_at')->take(1)->reverse();
            $chat->first = User::find($chat->firstPart);
            $chat->second = User::find($chat->secondPart);
            $chat->unread = Message::all()->where('chat_id',$chat->id)->where('status','waiting')->count();
            foreach($msgs as $msg){                
                $first = User::find($msg->sender_id);
                $second = User::find($msg->reciver_id);
                $msg->firstPart=$first;
                $msg->secondPart=$second;}            
            $chat->msgs=$msgs;
        }
        $this->chats = $chats;
        // dd($chats);
    }

    public function render()
    {
        $this->getChats($this->user_id);
        return view('livewire.subchat',['chats'=>$this->chats,]);
    }
}

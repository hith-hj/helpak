<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Message;
use App\Chat;
use App\User;
use Auth;
use DB;

class Chats extends Component
{
    protected $chats;
    protected $firstPart;
    public $user_id;

    public function mount($id){
        $this->user_id = $id;
    }
    public function getChats($id){
        $chats = DB::table('chats')->where('firstPart', $id)->orWhere('secondPart', $id)->where('status','<>','erased')->latest('updated_at')->get();
        // dd($chats);
        foreach($chats as $chat)
        {
            $chat->first = User::find($chat->firstPart);
            $chat->second = User::find($chat->secondPart);
            $chat->unread = Message::all()->where('chat_id',$chat->id)->where('reciver_id',Auth::user()->id)->where('viewed','<',2)->count();
            $msg = Message::all()->where('chat_id',$chat->id)->sortByDesc('created_at')->first();   
            $msg->firstPart= User::find($msg->sender_id);
            $msg->secondPart= User::find($msg->reciver_id);                         
            $chat->msg=$msg;
        }
        // dd($chats);
        $this->chats = $chats;
    }

    public function blockChat($id)
    {
        $blk = Chat::find($id);
        if($blk->status !== 'blocked')
        {
            $blk->status = 'blocked';
            $blk->done_by = Auth::user()->id;
        }elseif($blk->status === 'blocked' && $blk->done_by === Auth::user()->id ){
            $blk->status = 'waiting';
        }            
        $blk->save();
    }

    public function muteChat($id)
    {
        $blk = Chat::find($id);
        if($blk->status !== 'muted')
        {
            $blk->status = 'muted';
            $blk->done_by = Auth::user()->id;
        }elseif($blk->status === 'muted' && $blk->done_by === Auth::user()->id ){
            $blk->status = 'waiting';
        }            
        $blk->save();
    }
    
    public function deleteChat($id)
    {
        $blk = Chat::find($id);
        if($blk->status !== 'deleted'){
            $blk->status = 'deleted';
            $blk->done_by = Auth::user()->id;
        }elseif($blk->status === 'deleted' && $blk->done_by === Auth::user()->id ){
            $blk->status = 'waiting';
        }            
        $blk->save();
    }

    public function deletePermanent($id)
    {
        // $msg = Message::all()->where('chat_id',$id);
        $msg = DB::table('messages')->where('chat_id',$id);
        $msg->delete();
        // $chat = Chat::find($id);
        $chat = DB::table('chats')->where('id',$id)->take(1);
        $chat->delete();
    }

    public function render()
    {
        $this->getChats($this->user_id);
        return view('livewire.chats',['chats'=>$this->chats,]);
    }
}

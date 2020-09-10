<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Message;
use App\User;
use App\Chat;
use App\Notification;
use Auth;

class Messages extends Component
{
    
    public $totalMsgs;
    public $msgContent;
    public $dest;
    public $status;
    public $newMsgs;
    protected $listeners = ['msgsScrollingUp'=>'stopFetching','msgsScrollingDown'=>'resumeFetching'];
    protected $messages;
    protected $chat_id;
    protected $firstPart;
    protected $chat_it;

    public function mount($id)
    {
        $this->chat_id = $id;
        // $this->getMessages($this->chat_id);
        $view = Message::all()->where('chat_id',$id);
        foreach($view as $vie)
        { 
            if($vie->sender_id !== Auth::user()->id)           
                {$vie->viewed = 2;}
            else 
                {$vie->viewed = 1;}
            $vie->save();               
        }
        
    }

    public function stopFetching()
    {
        // dd('here');
        $this->status = 'stoped';
    }
    public function resumeFetching()
    {
        // dd('here');
        $this->status = 'resume';
    }

    public function getMessages($id)
    {
        $chat = Chat::find($id);
        $this->chat_it = $chat;
        if($chat->firstPart==Auth::user()->id)
        {
            $this->firstPart = User::find($chat->secondPart);
            $this->dest =  $chat->secondPart;
        }else{
            $this->firstPart = User::find($chat->firstPart);
            $this->dest =  $chat->firstPart; 
        }
        $this->totalMsgs = $chat->msgsCount;
        $this->messages = Message::all()->where('chat_id',$id)->sortByDesc('created_at')->reverse();
        $this->newMsgs = Message::all()->where('chat_id',$id)->where('reciver_id',Auth::user()->id)
            ->where('viewed','!=',2)->count();
        foreach($this->messages as $msg)
        {
            if($msg->sender_id !== Auth::user()->id && $msg->viewed != 2)           
                {
                    $msg->viewed = 2;
                    $msg->save();
                }     
            $msg->firstPart=User::find($msg->sender_id);
            $msg->secondPart=User::find($msg->reciver_id);        
        }     
        // $this->emit("NewRecivedMsg");   
    }

    public function sendMsg($id)
    {  
        if(strlen($this->msgContent)>0)
        {
            $chat = Chat::find($id);         
            $set = new Message();
            $set->chat_id = $id;
            $set->source = 'chat';
            $set->sender_id = Auth::user()->id;
            $set->reciver_id = $this->dest;
            $set->message = $this->msgContent;
            $set->status = $chat->status;
            $set->viewed = 1;
            $set->done_by = $chat->done_by;
            $set->save();    
            $chat->msgsCount +=1;
            $chat->save();
            $this->msgContent = "";
            $this->emit("NewSentMsg");
        }
    }

    public function render()
    {  
        if($this->status !== 'stoped')
        {$this->getMessages($this->chat_id);}
        return view('livewire.messages',['msgs'=>$this->messages,'chatid'=>$this->chat_id,'fp'=>$this->firstPart,'chat_it'=>$this->chat_it,]);
    }
}

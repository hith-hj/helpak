<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Likes;
use App\Post;
use App\Comments;
use App\User;
use App\Ask;
use App\Notification;
use App\Message;
use Auth;
use DB;

class Navbar extends Component
{
    public $query;
    protected $userId;
    protected $result;
    protected $notification;
    protected $messages;
    protected $listeners = ['getNavUpdates'=>'render'];

    public function mount(){
        $this->userId = Auth::user()->id ; 
        $this->getNotification();
    }

    // public function updates(){
    //     dd('updates');
    // }

    public function getNotification()
    {
        $notification = Notification::all()->where('reciver_id',$this->userId)->where('viewed',0)->sortByDesc("created_at");
        foreach($notification as $noti){
            $noti->sender = User::find($noti->sender_id);
        }
        // dd($notification);
        $this->notification = $notification;
    }

    public function setNotiSeen($id)
    {
        $get = Notification::find($id);
        $get->viewed = 1;
        $get->save();
    }

    public function getMessages()
    {
        $unread = Message::all()->where('reciver_id',Auth::user()->id)->where('viewed','!=',2);
        foreach($unread as $msg){
            $msg->firstPart=User::find($msg->sender_id);
            $msg->secondPart=User::find($msg->reciver_id);              
        } 
        $this->messages = $unread;
    }

    public function setMsgSeen($id)
    {
        $get = Message::find($id);
        if($get->sender_id !== Auth::user()->id && $get->viewed < 2)           
            {$get->viewed = 2;}
        else 
            {$get->viewed = 1;}
    }

    public function getUpdates()
    {
        $this->emit('navUpdated');
        $this->getMessages();
        $this->getNotification();
        
    }

    public function updatedQuery(){
        $quer = str_replace(' ', '', $this->query);
        if( strlen($this->query)>0 && $quer[0] == '@')
        {
            switch ($quer) 
            {
                case '@donation':
                    return redirect()->route('funding');
                    break;
                case '@تبرعات':
                    return redirect()->route('funding');
                    break;
                case '@home':
                    return redirect()->route('home');
                    break;
                case '@asks':
                    return redirect()->route('asks');
                    break;
                case '@chats':
                    return redirect()->route('chats');
                    break;                
                case '@logout':
                    $this->emit("Logout");
                    break;                
                case '@خروج':
                    $this->emit("Logout");
                    break;                
                default:
                    break;
            }
        }else{
            $result = DB::table('searches')->
                      where('content','like','%' . $this->query . '%')->
                      orderByDesc('created_at')->get()->take(5);
            foreach($result as $res)
            {
                if($res->type == 'post')
                {
                    $post = Post::find($res->dest_id);
                    if ($post !== null)
                    {
                        $res->info  = $post;
                    }else{
                        $res->info = 'deleted';
                    }
                } elseif ($res->type == 'user') {
                    $res->info = User::find($res->dest_id);
                }                 
            }
            // dd($result);
            $this->result = $result;
        }
    }

    public function render()
    {
        $this->getUpdates();
        return view('livewire.navbar',['notification'=>$this->notification,'result'=>$this->result , 'unread'=>$this->messages,]);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Likes;
use App\Post;
use App\Comments;
use App\Ask;
use App\Redos;
use App\User;
use App\Saved;
use App\Links;
use App\Rate;
use App\Chat;
use App\Report;
use App\Message;
use App\Notification;
use Auth;
use DB;

class Showpost extends Component
{   
    public $allowedRate; 
    public $postLiked;    
    public $postRedos;  
    public $postAsks; 
    public $postEditId;
    public $postEditType;
    public $postChanges;
    public $postRequestId;
    public $postRequestCount;
    public $dakishMesssage;
    public $dakishInput;
    public $nextTimeToAllow;
    public $messageInputId;
    public $userMessage;
    public $comment;
    public $comid;
    public $editedComment;
    public $delete;
    public $reportid;
    public $reportcontent;
    protected $post;
    protected $user_id;
    protected $post_id;
    protected $post_type;

    public function mount($id,$type)
    {
        $this->user_id = Auth::user()->id;
        $this->post_id = $id;
        $this->post_type = $type;
        // $this->getPost($id,$type);
    }

    public function getPost($id,$type)
    {
        $this->post = Post::find($id);
        // dd($this->post);
        if($this->post !== null)
        {
            $this->check($this->post , $id);
        } else {
            return redirect()->route('home');
        }
        // dd($this->post);
    }
    
    public function check($ser ,$id)
    {
        $this->postLiked = [];
        $this->postRedos = [];
        $this->postAsks = [];
        $this->allowedRate = [];
        $this->nextTimeToAllow = [];
        $this->post["likes"] = Likes::all()->where('post_id',$id)->sortByDesc('created_at');
        foreach($this->post["likes"] as $like)
        {
            $like["user_info"] = User::find($like->user_id);
        }
        $this->post["redos"] = Redos::all()->where('post_id',$id)->sortByDesc('created_at');
        foreach($this->post["redos"] as $redo)
        {
            $redo["user_info"] = User::find($redo->redo_user_id);
        } 
        $this->post["comments"] =  Comments::all()->where('post_id',$id)->sortByDesc('created_at');
        foreach($this->post["comments"] as $com)
        {
            $com["user_info"] = User::find($com->user_id);
        }          
        $this->post["asks"] =  Ask::all()->where('post_id',$id)->sortByDesc('created_at');
        foreach($this->post["asks"] as $ask)
        {
            $ask["user_info"] = User::find($ask->sender_id);
        }
        $this->post["user_info"] = User::find($this->post->user_id); 
        
        foreach($ser->likes as $lik )
        {
            if($this->user_id === $lik->user_id)
            { 
                $this->postLiked[] .= $lik->post_id ;
            }
        }
        if($ser->user_name === Auth::user()->name && $ser->type === 'redo')
        {
            $this->postRedos[] .= $ser->id ;
        }
        $asks = Ask::all()->where('post_id',$ser->id)->where('sender_id',$this->user_id)->first();
        if($asks !== null && $this->user_id === $asks->sender_id )
        {
            $this->postAsks[] .= $ser->id; 
        } 
    }

    public function like($id,$type)
    {
        // dd($type,$id);
            $likes = new Likes;
            $likes->post_id = $id;
            $likes->post_type = $type;
            $likes->user_id = Auth::user()->id;
            $likes->user_name = Auth::user()->name;
            $likes->save(); 
            // if($type == 'service'){
            //     $edit = Service::find($id);                
            // }else{
            //     $edit = Dakish::find($id);
            // }
            $edit = Post::find($id);
            $edit->likeCount += 1 ;
            $edit->save(); 
                     
    }

    public function dislike($id,$type)
    {
        $likes = Likes::where('post_type',$type)->where('post_id',$id)->where('user_id',$this->user_id)->first();
        $likes->delete();  
        $edit = Post::find($id);
        $edit->likeCount -= 1 ;
        $edit->save();      
    }

    public function addComment($id,$type)
    {
        // dd($id , $type);
        $com = new Comments();
        $com->post_id = $id;
        $com->post_type = $type;
        $com->user_id = Auth::user()->id;
        $com->user_name = Auth::user()->name;
        $com->content = $this->comment["postId".$id];
        $com->save();
        $edit = Post::find($id);
        $edit->commentCount += 1 ;
        $edit->save();
        $this->comment["postId".$id] = '';
    }

    public function editComment($id)
    {
        $com = Comments::find($id);
        $com->content = $this->editedComment;
        $com->save();
        $this->editedComment = '';
        $this->comid = '';

        // dd($this->editedComment);
    }

    public function deleteComment($id,$type)
    {
        //dd($id,$type);
        $comdel=Comments::find($id);
        $comdel->delete();
        
    }

    public function preventComment($id)
    {
        $get = Post::find($id);
        if($get->commentCount == 'notallowed'){
            $com = Comments::all()->where('post_id',$id)->count();
            $get->commentCount = $com;
            $get->save();
        }else{
            $get->commentCount = 'notallowed';
            $get->save();
        }
        
    }

    public function rating($cate)
    {
        $rate = Auth::user();
        $rate->rate += 5 ;
        $rate->$cate += 1 ;
        $rate->save();
    }
    
    public function reDoService($id,$type)
    {
        $get = Post::find($id);
        $get->redoCount +=1;
        $puid = $get->user_id;
        $content = $get->content;
        $get->save();
        $this->emit("redoService",$content,$type);
        $this->storeRedo($puid , $id ,$type );
        $this->rating("service");           
    }    

    public function storeRedo($pui,$id,$type)
    {
        $re = new Redos();
        $re->post_user_id = $pui;
        $re->redo_user_id = $this->user_id;
        $re->redo_user_name = Auth::user()->name;
        $re->post_id = $id ; 
        $re->post_type = $type ; 
        $re->save();
    }

    public function askPost($id,$type)
    {
        if(null != $this->dakishMesssage)
        {
            // dd($this->dakishMesssage);
            $message = $this->dakishMesssage;
            $typ = 'order';
        }else{
            $message = 'none';
            $typ = 'ask';
        }
        $serv = Post::find($id);
        $serv->requestNumber +=1;
        $serv->save();       
        $ask = new Ask();
        $ask->post_id = $id;
        $ask->post_type = $type;
        $ask->sender_id = $this->user_id;
        $ask->sender_name = Auth::user()->name;
        $ask->reciver_id = $serv->user_id;
        $ask->reciver_name = $serv->user_name;
        $ask->message = $message;
        $ask->status = 'waiting';
        $ask->type = $typ ;
        $ask->save();
        $this->setLink($serv->user_id,$id,$type);
        $this->emit("serviceAsked");
        $this->dakishInput = ''; 
    }

    public function setLink($id,$post_id,$type)
    {
        $first = Links::all()->where('first',$id)->where('second',Auth::user()->id)->first();
        if(!empty($first)){
            $first->rate += 1;
            $first->link_on .=', '.$post_id; 
            $first->save();            
        }else{
            Links::create([
                'first'=>$id ,
                'second'=>Auth::user()->id,
                'link_on'=>$post_id,
                'post_type'=>$type,
                'rate'=>0,
            ]);
        }
    }

    public function storePostChanges($id,$type)
    {
        $ser = Post::find($id);
        $ser->content = $this->postChanges;
        $ser->save();
        $this->postEdit = '';
        $this->emit("postEdited");
    }

    public function postDelete($id,$type)
    {
        // return
        $likes = DB::table('likes')->where('post_type',$type)->where('post_id',$id);
        $likes->delete();
        $comms = DB::table('comments')->where('post_type',$type)->where('post_id',$id);
        $comms->delete();
        $asks = DB::table('asks')->where('post_type',$type)->where('post_id',$id);
        $asks->delete();
        $ser = Post::find($id);
        $ser->delete();
    }

    public function savePost($id,$type)
    {
        $ser = Post::find($id);       
        $save = new Saved();
        $save->post_id = $ser->id;
        $save->post_type = $ser->type;
        $save->user_id = $ser->user_id;
        $save->saver_id = Auth::user()->id;
        $save->save();
        $this->emit("postSaved");
    }

    public function setRequestCount($id)
    {
        $this->validate(['postRequestCount'=>'required|integer',]);
        $set = Post::find($id);
        $set->requestCount = $this->postRequestCount;
        $set->save();
        $this->postRequestCount = '';
        $this->postRequestId = '';

    }

    public function userRate($id)
    {
        $get = Post::find($id);
        $id = $get->user_id;
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
        $this->emit('userRated');
        // dd($user); 
    }

    public function sendMessage($id)
    {
        $user = Post::find($id);
        $cht = chat::all()->where('firstPart',Auth::user()->id)->where('secondPart',$user->user_id)->first();
        $cht2 = chat::all()->where('firstPart',$user->user_id)->where('secondPart',Auth::user()->id)->first();
        if(empty($cht) && empty($cht2) ){
           $chat = new Chat();
            $chat->firstPart = Auth::user()->id;
            $chat->secondPart = $user->user_id;
            $chat->save(); 
            $chatId = $chat->id;
        } else{
            if($cht===null){$chatId =  $cht2->id; }
            else{$chatId = $cht->id;}
        }      
        $msg = new Message();
        $msg->chat_id = $chatId;
        $msg->source = 'post';
        $msg->sender_id = Auth::user()->id;
        $msg->Reciver_id = $user->user_id;
        $msg->message = $this->userMessage;
        $msg->status = 'waiting';
        $msg->save();
        $chats = Chat::find($chatId);
        $chats->msgsCount +=1;
        $chats->save();
        $this->emit('messageSent');
        $noti = new Notification();  
        $noti->add($chatId,'message',Auth::user()->id,$user->user_id,$this->userMessage);
        $this->userMessage = '';
        $this->messageInputId = '';
        
    }

    public function reportPost($id,$type)
    {
        $rep = new Report();
        $rep->reporter_id = Auth::user()->id;
        $rep->reported_id = $id;
        $rep->type = $type;
        $rep->report = $this->reportcontent;
        $rep->save();
        $this->reportcontent='';
        $this->reportid='';
        // dd($id,$this->reportcontent);
    }

    public function render()
    {
        $this->getPost($this->post_id,$this->post_type);
        return view('livewire.showpost',['ser'=>$this->post]);
    }
}

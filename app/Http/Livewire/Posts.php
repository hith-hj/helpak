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
use App\Setting;
use Auth;
use DB;
use Carbon\Carbon;
class Posts extends Component
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
    public $msg;
    protected $feeds;
    protected $feeds_type;
    protected $user_id;
    protected $listeners = ['feedService' => 'setType'];

    public function mount($id){        
        $this->user_id = $id ;
        $this->feeds_type = 'all' ;       
    }
    
    public function render(){
        $this->getFeeds($this->feeds_type,$this->user_id);
        return view('livewire.posts', ['feeds'=>$this->feeds,]);
    }

    public function setType($type){
        $this->feeds_type = $type;
    }

    public function getFeeds($type,$id){
        $this->feeds = null ;
        switch ($type) {
            case 'services':
                $this->feeds = Post::all()->where('user_id',$id)->where('title','service')->sortByDesc('created_at');
                break;
            case 'dakishs':
                $this->feeds = Post::all()->where('user_id',$id)->where('title','dakish')->sortByDesc('created_at');
                break;
            case 'redos':
                $this->feeds = Post::all()->where('user_id',$id)->where('type','redo')->sortByDesc('created_at');
                break;
            default:
                $this->feeds = Post::all()->where('user_id',$id)->sortByDesc('created_at');
        }
        // $this->feeds = Post::all()->sortByDesc('created_at');
        foreach($this->feeds as $ser){
                $ser["likes"] = Likes::all()->where('post_id',$ser->id)->sortByDesc('created_at');
                foreach($ser["likes"] as $com){
                    $image = User::find($com->user_id);
                    $commentUserImage = $image->image;
                    $com["user_image"] = $commentUserImage;
                }
                $ser["redos"] = Redos::all()->where('post_id',$ser->id)->sortByDesc('created_at');
                foreach($ser["redos"] as $com){
                    $image = User::find($com->redo_user_id);
                    $commentUserImage = $image->image;
                    $com["user_image"] = $commentUserImage;
                } 
                $ser["comments"] =  Comments::paginate(5)->where('post_id',$ser->id)->sortByDesc('created_at');
                foreach($ser["comments"] as $com){
                    $image = User::find($com->user_id);
                    $commentUserImage = $image->image;
                    $com["user_image"] = $commentUserImage;
                }          
                $rate = User::find($ser->user_id);
                $ser["user_info"] = $rate;
                $ser["user_setting"] = Setting::find($rate->setting_id);
            } 
        $this->checkEach($this->feeds);
    }

    public function checkEach($feeds){
        $this->postLiked = [];
        $this->postRedos = [];
        $this->postAsks = [];
        $this->allowedRate = [];
        $this->nextTimeToAllow = [];
        foreach($feeds as $ser ){                  
            foreach($ser->likes as $lik ){
                if(in_array($this->user_id , $lik->toArray())){ $this->postLiked[] .= $lik->post_id ; } }
            if($ser->user_name === Auth::user()->name && $ser->type === 'redo'){ $this->postRedos[] .= $ser->id ; }
            $asks = Ask::all()->where('post_id',$ser->id)->where('sender_id',$this->user_id)->first();
            if($asks !== null && $this->user_id === $asks->sender_id ){ $this->postAsks[] .= $ser->id; }
            $rates = Rate::all()->where('rated_user_id',$ser->user_id)->where('rated_by_id',$this->user_id)->first();
            if($rates == null || $rates->nextDateToAllowe < Carbon::now()){
                $this->allowedRate[] .=$ser->user_id;
            }else{
                $ser["nextDateToAllow"] = $rates->nextDateToAllowe;
            }
        }  
        // dd($this->allowedRate,$this->nextTimeToAllow);
    }
    
    public function like($id,$type){
            $likes = new Likes;
            $likes->post_id = $id;
            $likes->post_type = $type;
            $likes->user_id = Auth::user()->id;
            $likes->user_name = Auth::user()->name;
            $likes->save(); 
            $edit = Post::find($id);
            $edit->likeCount += 1 ;
            $edit->save();
            $noti = new Notification();  
            $noti->add(Auth::user()->id,$edit->user_id,$id,'like','liked your'); 
                     
    }

    public function dislike($id,$type){
        $likes = Likes::where('post_type',$type)->where('post_id',$id)->where('user_id',$this->user_id)->first();
        $likes->delete();  
        $edit = Post::find($id);
        $edit->likeCount -= 1 ;
        $edit->save();      
    }

    public function addComment($id,$type){
        if($this->comment["postId".$id] !== null){
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
            $noti = new Notification();  
            $noti->add(Auth::user()->id,$edit->user_id,$id,'comment',$this->comment["postId".$id]);
        }        
    }

    public function editComment($id){
        $com = Comments::find($id);
        $com->content = $this->editedComment;
        $com->save();
        $this->editedComment = '';
        $this->comid = '';

        // dd($this->editedComment);
    }

    public function deleteComment($id,$type){
        //dd($id,$type);
        $comdel=Comments::find($id);
        if($comdel !== null)
            $comdel->delete();
        
    }

    public function preventComment($id){
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

    public function rating($cate){
        $rate = Auth::user();
        $rate->rate += 5 ;
        $rate->$cate += 1 ;
        $rate->save();
    }
    
    public function reDoService($id,$type){
        $get = Post::find($id);
        $get->redoCount +=1;
        $puid = $get->user_id;
        $content = $get->content;
        $get->save();        
        $this->storeRedo($puid , $id ,$type );
        $this->setLink($get->user_id,$id,$type,'redo');
        $noti = new Notification();  
        $noti->add(Auth::user()->id,$puid,$id,'redo','redo your post');
        $this->rating($type);   
        $this->emit("redoService",$content,$type);        
    }    

    public function storeRedo($pui,$id,$type){
        $re = new Redos();
        $re->post_user_id = $pui;
        $re->redo_user_id = $this->user_id;
        $re->redo_user_name = Auth::user()->name;
        $re->post_id = $id ; 
        $re->post_type = $type ; 
        $re->save();
    }

    public function askPost($id,$type){
        if(null != $this->dakishMesssage){
            // dd($this->dakishMesssage);
            $message = $this->dakishMesssage;
            $typ = 'order';
        }else{
            $message = 'none';
            $typ = 'ask';
        }
        $serv = Post::find($id);
        $serv->requestNumber +=1;
        $cont = $serv->content;
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
        $ask->post = $cont ;
        $ask->save();
        $this->dakishInput = '';
        $this->dakishMesssage= ''; 
        $this->setLink($serv->user_id,$id,$type,'ask');
        $noti = new Notification();  
        $noti->add(Auth::user()->id,$serv->user_id,$id,'ask','you got new ask');
        $this->emit("serviceAsked");
        
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

    public function storePostChanges($id,$type){
        $ser = Post::find($id);
        $ser->content = $this->postChanges;
        $ser->save();
        $this->postEdit = '';
        $this->emit("postEdited");
    }

    public function postDelete($id,$type){
        try{
            $likes = Likes::all()->where('post_type',$post_type)->where('post_id',$id);
            $likes->delete();
            $comms = Comments::all()->where('post_type',$post_type)->where('post_id',$id);
            $comms->delete();
        }
        catch(\Exception $err){
            return $err->getMessage();
            $this->status = 'error';
        }
        finally{ 
            $ser = Post::find($id);           
            $ser->delete();
            $this->emit("postDeleted");
        }
    }

    public function savePost($id,$type){
        $ser = Post::find($id);       
        $save = new Saved();
        $save->post_id = $ser->id;
        $save->post_type = $ser->type;
        $save->user_id = $ser->user_id;
        $save->saver_id = Auth::user()->id;
        $save->save();
        $this->emit("postSaved");
    }

    public function setRequestCount($id){
        $this->validate(['postRequestCount'=>'required|integer',]);
        $set = Post::find($id);
        $set->requestCount = $this->postRequestCount;
        $set->save();
        $this->postRequestCount = '';
        $this->postRequestId = '';

    }

    public function userRate($pid){
        $get = Post::find($pid);
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
        $this->setLink($get->user_id,$id,'user','rate');
        $noti = new Notification();  
        $noti->add(Auth::user()->id,$id,$pid,'rate','you got rated by');        
        $this->emit('userRated');
        // dd($user); 
    }

    public function sendMessage($id){
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
        if(strlen($this->userMessage)>0) {     
        $msg = new Message();
        $msg->chat_id = $chatId;
        $msg->source = 'post';
        $msg->sender_id = Auth::user()->id;
        $msg->Reciver_id = $user->user_id;
        $msg->message = $this->userMessage;
        $msg->status = 'waiting';
        $msg->viewed = 0;
        $msg->save();
        $chats = Chat::find($chatId);
        $chats->msgsCount +=1;
        $chats->save();
        $this->emit('messageSent');
        $noti = new Notification();  
        $noti->add(Auth::user()->id,$user->user_id,$chatId,'message',$this->userMessage);
        $this->setLink($user->user_id,$id,'user','message');  
        $this->userMessage = '';
        $this->messageInputId = '';}
        
    }

    public function reportPost($id,$type){
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

}
<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Ask;
use App\User;
use App\Notification;
use Auth;
use App;

class Asks extends Component
{
    protected $asks;
    protected $user_id;
    public $typeAsk = 'reciver_id';
    public $title;
    public $askid;

    public function mount($id){
        $this->user_id = $id;
    }

    public static function trest()
    {
        dd('trest');
    }

    public function getAsks($id,$type){
        if($type == 'sender_id')
            $this->title = 'Sent';
        else 
            $this->title = 'Recieved';
        $asks = Ask::all()->where($type,Auth::user()->id)->where('status','<>','deleted')->reverse();
        foreach($asks as $ask){
            $ask["sender"] = User::find($ask->sender_id);
            $ask["reciver"] = User::find($ask->reciver_id);
        }
        $this->asks = $asks;
    }

    public function accept($id){
        $ask = Ask::find($id);
        if($ask !== null){
        $ask->status = 'accepted';
        $ask->save();}
        $this->response($id,'accepted');
    }

    public function reject($id){
        $ask = Ask::find($id);
        if($ask !== null){
        $ask->status = 'rejected';
        $ask->save();}
        $this->response($id,'rejected');
    }

    public function ignore($id){
        $ask = Ask::find($id);
        if($ask !== null){
        $ask->status = 'ignored';
        $ask->save();}
        $this->response($id,'ignored');
    }

    public function delete($id){
        $ask = Ask::find($id);
        if($ask !== null){
        $ask->status = 'deleted';
        $ask->save();}
        $this->response($id,'deleted');
    }

    public function response($id,$type){
        $ask = Ask::find($id);
        if($ask->sender_id == Auth::user()->id){
            $dest = $ask->reciver_id;
        }else{
            $dest = $ask->sender_id;
        }
        $noti = new Notification();  
        $noti->add(Auth::user()->id,$dest,$id,'response',$type);
    }

    public function render()
    {   
        $this->getAsks($this->user_id,$this->typeAsk);
        return view('livewire.asks',['asks'=>$this->asks,]);
    }

    
}

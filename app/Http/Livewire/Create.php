<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Service;
use App\Dakish;
use App\Post;
use Carbon\Carbon;
use App\Search;
use App\Setting;
use Toastr;
use Auth;
use File;
use App;

class Create extends Component
{   
    public $lang;
    public $imageInput;
    public $status = '';
    public $cover;
    public $post_type= 'none';
    public $post_content;
    public $placeholder='Pick';
    public $dakishId;
    protected $listeners = ['redoService' => 'redoPost'];

    public function setType($type){
        $this->lang = App::getLocale();
        if($this->lang == 'en'){
            if($type == 'service'){
                $this->placeholder = 'Service';
                $this->imageInput = 0;
                $this->post_type = 'service';
            }elseif($type == 'dakish'){
                $this->placeholder = 'Dakish';
                $this->imageInput = 1;
                $this->post_type = 'dakish';
            }else{
                $this->placeholder = 'Chose a type !!!!!!!!!';
                $this->imageInput = 0;
            }
        }else{
            if($type == 'service'){
                $this->placeholder = 'خدمة';
                $this->imageInput = 0;
                $this->post_type = 'service';
            }elseif($type == 'dakish'){
                $this->placeholder = 'مبادلة';
                $this->imageInput = 1;
                $this->post_type = 'dakish';
            }else{
                $this->placeholder ='!!!!! اختر نوع ';
                $this->imageInput = 0;
            }
        }
    }
    
    public function storeNew(){
        if($this->post_type == 'service'){
            $this->newPost($this->post_type);
        }elseif($this->post_type == 'dakish'){
            $this->newPost($this->post_type);
            // $this->emit('upload_image');
        }else{
            $this->setType('none');
        }
    }

    public function newPost($type){
        if($type == 'service'){
            $id = rand(50000001,100000000);
            $title = $type;
            $rate = Auth::user();
            $rate->rate += 10 ;
            $rate->service += 1 ;
            $rate->save();
        }else{
            $id = rand(0,50000000);
            $this->dakishId = $id;
            $this->emit('upload_image');
            $title = $type;
            $rate = Auth::user();
            $rate->rate += 10 ;
            $rate->dakish += 1 ;
            $rate->save();            
            // HomeController::uploadDakishImage($id);
            
        }
        $this->validate(['post_content'=>'required|max:1500',]);
        $sett = Setting::find(Auth::user()->setting_id);
        try{
            $post = new Post();
            $post->id = $id;
            $post->title = $title;
            $post->user_id = Auth::user()->id ;
            $post->user_name = Auth::user()->name ;
            $post->user_role = Auth::user()->role ;
            $post->content =  $this->post_content;
            $post->type = "New" ;
            if($sett->address == 'yes'){
                $post->address = Auth::user()->address;}
            else{
                $post->address = 'Not Available';}
            if($sett->phone === 'yes'){
                $post->phone = Auth::user()->phone;}
            else{
                $post->phone = 'Not Available';}
            $post->save(); 
        }catch(\Exception $err){
            return $err->getMessage();
            $this->status = 'error';
        }finally{
            $inde = new Search();
            $inde->setIndex($title,$this->post_content,'post',$id);
            $this->post_content = '' ;
            $this->status = 'Done';
            $this->emit('postCreated');           
        }    
    }

    public function redoPost($content , $type){
        // dd($content,$type);
        if($type == 'service'){
            $id = rand(50000001,100000000);
            $title = $type;
            $rate = Auth::user();
            $rate->rate += 10 ;
            $rate->service += 1 ;
            $rate->save();
        }else{
            $id = rand(0,50000000);
            $title = $type;
            $rate = Auth::user();
            $rate->rate += 10 ;
            $rate->dakish += 1 ;
            $rate->save();
        }
        $sett = Setting::find(Auth::user()->setting_id);
        try{  
            $post = new Post();
            $post->id = $id;
            $post->title = $title;
            $post->user_id = Auth::user()->id ;
            $post->user_name = Auth::user()->name ;
            $post->user_role = Auth::user()->role ;
            $post->content =  $content;
            $post->type = "redo" ;
            if($sett->address == 'yes'){
                $post->address = Auth::user()->address;}
            else{
                $post->address = 'Not Available';}
            if($sett->phone === 'yes'){
                $post->phone = Auth::user()->phone;}
            else{
                $post->phone = 'Not Available';}
            $post->save(); 
        }catch(\Exception $err){
            return $err->getMessage();
            $this->status = 'error';
        }finally{
            $this->emit('postCreated');
        }

    }

    public function render(){
        return view('livewire.Create');
    }
    
}

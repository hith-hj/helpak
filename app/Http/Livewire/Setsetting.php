<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Setting;
use Auth;

class Setsetting extends Component
{
    protected $setting;
    public $phone ,
     $address ,
     $message ,
     $info ,
     $post ,
     $rate , 
     $active ,
     $fixed ;
    
    public function getSetting(){
        $this->setting = Setting::find(Auth::user()->setting_id);
        $this->phone = $this->setting->phone;
        $this->address = $this->setting->address;
        $this->message = $this->setting->can_send_message;
        $this->info = $this->setting->can_see_myinfo;
        $this->post = $this->setting->can_see_mypost;
        $this->rate = $this->setting->can_rate;

    }

    public function updateSet($dest){
        switch ($dest) {
            case 'phone':
                $this->fixed = $this->phone;
                break;
            case 'address':
                $this->fixed = $this->address;
                break;
            case 'can_see_mypost':
                $this->fixed = $this->post;
                break;
            case 'can_see_myinfo':
                $this->fixed = $this->info;
                break;
            case 'can_send_message':
                $this->fixed = $this->message;
                break;
            case 'can_rate':
                $this->fixed = $this->rate;
                break;            
            default:
                break;
        }
        // if($this->fixed !== null){
        $update = Setting::find(Auth::user()->setting_id);
        $update->$dest = $this->fixed;
        $update->save();
        $this->active = '';
        // }
        // dd($dest);
    }

    public function render()
    {
        $this->getSetting();
        return view('livewire.setsetting',['setting'=>$this->setting,]);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use App\Redos;
use Auth;
class Widgets extends Component
{
    protected $people;
    protected $redos;
    protected $user_id;
    public function mount(){
        $this->user_id = Auth::user()->id;
        $this->people = User::all()->where('rate','>=',70)->where('id','<>',$this->user_id)->sortByDesc('rate')->take(5);
        $redos = Redos::all()->sortByDesc('created_at')->take(5);
        $this->getData($redos);
    }
    public function getData($redos){
        foreach($redos as $redo){
            $info = User::find($redo->redo_user_id);
            $redo["info"] = $info->name;
            $redo["user_image"] = $info->image;
            $redo["user_rate"] = $info->rate;
        }
        $this->redos = $redos;
    }

    public function render()
    {
        return view('livewire.widgets',['people'=>$this->people,'redos'=>$this->redos,]);
    }
}

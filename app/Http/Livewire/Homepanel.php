<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;

class Homepanel extends Component
{
    protected $infos;
    public $user_id;
    public function mount($id){
        $this->infos = User::find($id);
    }
    public function render()
    {
        return view('livewire.homepanel',['info' => $this->infos]);
    }
}

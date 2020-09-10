<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User;
use App\Post;
use App\Saved;
use Auth;

class Saves extends Component
{   
    protected $saves;
    
    public function render()
    {
        $this->getSaves();
        return view('livewire.saves',['saves'=>$this->saves]);
    }

    public function getSaves()
    {       
        $saves = Saved::all()->where('saver_id',Auth::user()->id);
        foreach ($saves as $save)
        {
            $save["user_info"] = User::find($save->user_id);
            $save["post_info"] = Post::find($save->post_id);
        }
        $this->saves = $saves;
    }

    public function deleteSave($id)
    {
        $save = Saved::find($id);
        $save->delete();
    }
}

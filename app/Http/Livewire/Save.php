<?php

namespace App\Http\Livewire;

use App\Lol;
use Livewire\Component;

class Save extends Component
{
    public $text;
    public function save(){
        $id = \Auth::id();
//        $item =Lol::where("id_user",'=',$id)->get()->all()->update(['ip' =>$this->text]);
        $affected = Lol::where("id_user",'=',$id)
            ->update(['ip' =>$this->text]);
        dd($affected);

    }
    public function render()
    {
        $id = \Auth::id();
        $get_all =Lol::where("id_user",'=',$id)->get()->last();
        return view('livewire.save',compact('get_all'));
    }
}

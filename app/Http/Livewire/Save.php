<?php

namespace App\Http\Livewire;

use App\Lol;
use Livewire\Component;

class Save extends Component
{
    public $text;
    public function save(){
        $id = \Auth::id();
        $get_all =Lol::where("id_user",'=',$id)->get()->all();
        foreach ($get_all as $item){
        $mm = Lol::find($item->id);



        $mm->ip = $this->text;

    }
        dd($mm);

    }
    public function render()
    {
        return view('livewire.save');
    }
}

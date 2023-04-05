<?php

namespace App\Http\Livewire;

use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;

class Counter extends Component
{
    public $count = 0;
    public $name = '';

    public function increment()
    {
        $this->count++;
    }

    public function mount()
    {
        $this->name = 'mount';
    }

    public function updated()
    {
        $this->name = 'updated';
    }

    public function mouseOver()
    {
        $this->name = 'mouseOver';
    }

    public function render()
    {
        return view('livewire.counter');
    }
}

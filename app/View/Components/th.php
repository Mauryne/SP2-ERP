<?php

namespace App\View\Components;

use Illuminate\View\Component;

class th extends Component
{
    public $text;
    public $class;
    public $dataSort;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text = null, $class=  null, $dataSort = null)
    {
        $this->text = $text;
        $this->class = $class;
        $this->dataSort = $dataSort;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.th');
    }
}

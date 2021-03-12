<?php

namespace App\View\Components;

use Illuminate\View\Component;

class a extends Component
{
    public $text;
    public $href;
    public $class;
    public $dataSort;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text = null, $href = null, $class = null, $dataSort = null)
    {
        $this->text = $text;
        $this->href = $href;
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
        return view('components.a');
    }
}

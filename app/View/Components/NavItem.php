<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NavItem extends Component
{
    public $href;
    public $text;
    public $class;
    public $classItem;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class = null, $href = null, $text = null, $classItem = null)
    {
        $this->href = $href;
        $this->text = $text;
        $this->class = $class;
        $this->classItem = $classItem;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.nav-item');
    }
}

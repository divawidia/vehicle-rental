<?php

namespace App\View\Components\Admin\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public string $name;
    public string $id;
    public string $label;
    public bool $required;
    public bool $multiple;
    public bool $isModal;
    public function __construct($name, $id = null, $label = null, $required = true, $multiple = false, $isModal = false)
    {
        $this->name = $name;
        $this->id = $id ?? $name; // Default ID to the name
        $this->label = $label;
        $this->required = $required;
        $this->multiple = $multiple;
        $this->isModal = $isModal;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.forms.select');
    }
}

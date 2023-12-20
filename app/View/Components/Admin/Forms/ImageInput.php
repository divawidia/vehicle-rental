<?php

namespace App\View\Components\Admin\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageInput extends Component
{
    public string $name;
    public string $id;
    public string $label;
    public mixed $value;
    public bool $required;

    public function __construct($name, $id = null, $label = null, $value = null, $required = true)
    {
        $this->name = $name;
        $this->id = $id ?? $name; // Default ID to the name
        $this->label = $label;
        $this->value = $value;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.forms.image-input');
    }
}

<?php

namespace App\View\Components\Admin\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextArea extends Component
{
    public string $name;
    public string $id;
    public string $label;
    public mixed $value;
    public string $placeholder;
    public bool $required;
    public bool $isModal;
    public bool $isCkeditor;

    public function __construct($name, $id = null, $label = null, $value = null, $placeholder = null, $required = true, $isModal = false, $isCkeditor = true)
    {
        $this->name = $name;
        $this->id = $id ?? $name; // Default ID to the name
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->isModal = $isModal;
        $this->isCkeditor = $isCkeditor;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.forms.text-area');
    }
}

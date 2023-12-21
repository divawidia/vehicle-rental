<?php

namespace App\View\Components\Admin\Modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public string $id;
    public string $title;
    public string $formId;
    public string $size;
    public bool $editForm;

    public function __construct($id, $title = '', $formId = '', $size = '', $editForm = false)
    {
        $this->id = $id;
        $this->title = $title;
        $this->formId = $formId;
        $this->size = $size;
        $this->editForm = $editForm;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.modals.form');
    }
}

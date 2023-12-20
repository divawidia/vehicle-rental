<?php

namespace App\View\Components\Admin\Cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public string $actionRoute;
    public bool $isEdit;
    public string $title;
    public string $backRoute;
    public string $backButtonTolltips;
    public string $submitButtonTolltips;
    /**
     * Create a new component instance.
     */
    public function __construct($actionRoute, $isEdit = false, $title = '', $backRoute = '#', $backButtonTolltips = '', $submitButtonTolltips = '')
    {
        $this->actionRoute = $actionRoute;
        $this->isEdit = $isEdit;
        $this->title = $title;
        $this->backRoute = $backRoute;
        $this->backButtonTolltips = $backButtonTolltips;
        $this->submitButtonTolltips = $submitButtonTolltips;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.cards.form');
    }
}

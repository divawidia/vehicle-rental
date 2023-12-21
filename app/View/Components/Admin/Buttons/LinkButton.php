<?php

namespace App\View\Components\Admin\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LinkButton extends Component
{
    /**
     * Create a new component instance.
     */
    public string $size;
    public string $additionalClass;
    public string $color;
    public string $icon;
    public string $text;
    public string $route;
    public string $tooltipsTitle;
    public string $iconMargin;
    /**
     * Create a new component instance.
     */
    public function __construct($color = 'primary', $icon = '', $route = '#', $additionalClass ='', $text = '', $tooltipsTitle = '', $size = '', $iconMargin = 'me-2')
    {
        $this->size = $size;
        $this->additionalClass = $additionalClass;
        $this->color = $color;
        $this->icon = $icon;
        $this->text = $text;
        $this->route = $route;
        $this->tooltipsTitle = $tooltipsTitle;
        $this->iconMargin = $iconMargin;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.buttons.link-button');
    }
}

<?php

namespace App\View\Components\Admin\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BasicButton extends Component
{
    /**
     * Create a new component instance.
     */
    public string $type;
    public string $color;
    public string $size;
    public string $text;
    public ?string $icon;
    public ?string $iconMargin;
    public ?string $additionalClass;
    public ?string $tooltipsTitle;

    public function __construct(
        string $type = 'button',
        string $color = 'primary',
        string $size = 'md',
        string $text = '',
        string $icon = null,
        string $iconMargin = 'me-2',
        string $additionalClass = '',
        string $tooltipsTitle = ''
    ) {
        $this->type = $type;
        $this->color = $color;
        $this->size = $size;
        $this->text = $text;
        $this->icon = $icon;
        $this->iconMargin = $iconMargin;
        $this->additionalClass = $additionalClass;
        $this->tooltipsTitle = $tooltipsTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.buttons.basic-button');
    }
}

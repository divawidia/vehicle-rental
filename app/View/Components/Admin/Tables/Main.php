<?php

namespace App\View\Components\Admin\Tables;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Main extends Component
{
    /**
     * Create a new component instance.
     */
    public $headers;
    public $tableId;

    public function __construct($headers, $tableId = 'table')
    {
        $this->headers = $headers;
        $this->tableId = $tableId;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.tables.main');
    }
}

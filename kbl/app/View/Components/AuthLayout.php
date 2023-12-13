<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AuthLayout extends Component
{
    public $title;
    public function __construct($title = null)
    {
        $this->title = $title ?? 'Koperasi Bintang Laguboti';
    }

    public function render()
    {
        return view('theme.auth.main');
    }
}

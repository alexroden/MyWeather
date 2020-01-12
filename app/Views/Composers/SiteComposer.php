<?php

namespace App\Views\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SiteComposer
{
    /**
     * @param \Illuminate\View\View $view
     */
    public function compose(View $view): void
    {
        $view->withAuth(Auth::user());
    }
}

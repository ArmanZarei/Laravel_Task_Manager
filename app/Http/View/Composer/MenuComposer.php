<?php


namespace App\Http\View\Composer;


use Illuminate\View\View;

class MenuComposer
{
    private $test;

    public function __construct()
    {
        $this->test = "Menu Composer Test Item";
    }

    public function compose(View $view)
    {
        $view->with('menuComposerTest', $this->test);
    }
}

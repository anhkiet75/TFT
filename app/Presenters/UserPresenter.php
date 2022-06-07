<?php

namespace App\Presenters;
use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {
    public function fullname() 
    {
        return 'Mr. ' . $this->name;
    }
}
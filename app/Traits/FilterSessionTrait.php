<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait FilterSessionTrait
{
    public $filter;

    public function pageName()
    {
        return \Request::route()->getName();
    }

    public function hasSession($key){
        return session()->has('filter.'.$this->pageName().'.'.$key);
    }

    public function getSession(){
        return session()->get('filter');
    }

    public function setItem($item, $value, $route = null){
        if (!$route){
            $route = $this->pageName();
        }
        Session::put('filter.'.$route.'.'.$item, $value);
    }

}
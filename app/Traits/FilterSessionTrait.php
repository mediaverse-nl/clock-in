<?php

namespace App\Traits;

use Illuminate\Support\Facades\Session;

trait FilterSessionTrait
{
    public $filter;

    public function pageName($route = null){
        if (!$route){
            $route = \Request::route()->getName();
        }
        return $route ;
    }

    public function hasSession($key){
        return session()->has('filter.'.$this->pageName().'.'.$key);
    }

    public function getSession(){
        return session()->get('filter');
    }

    public function getSessionKey($key){
        return array_get($this->getSession(), $this->pageName().'.'.$key);
    }

    public function setItem($item, $value, $route = null){
        Session::put('filter.'.$this->pageName($route).'.'.$item, $value);
    }

    public function sessionExists($name){
        return $this->hasSession($name) ? $this->getSessionKey($name) : null;

    }
}
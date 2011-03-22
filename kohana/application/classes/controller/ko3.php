<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Ko3 extends Controller
 {
    public function action_index()
     {
        $this->request->response = 'My First Kohana 3.0 Controller';
     }

public function action_another()
 {
    $this->request->response = 'Another action';

 }
 } // End


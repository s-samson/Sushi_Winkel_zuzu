<?php

class Customer
{
    public $id;
    public $fname;
    public $lname;
    public $email;
    public $adress;
    public $zipcode;

    public function __construct(){
        settype($this-> id, 'integer');
    }
}
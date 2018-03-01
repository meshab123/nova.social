<?php
    class Test2{
        public $name;
        public static $instant_count = 0;
        public function __construct(){
          echo "New test case is created. <br />";
        }

        public function __clone(){
            echo "Existing test was copied.<br />";
        }

    }

    $a = new Test2;
    $a->name = "coffee";
    echo $a->name . "<br />";


    $b = clone $a;

    echo $a->name . "<br />";
    echo $b->name . "<br />";

    echo "<hr />";

    $b->name = "Tea";

   echo "<hr />";

    echo $a->name . "<br />";
    echo $b->name . "<br />";

    echo "<hr />";
    //assignment by reference
    $c = $b;
    $c->name = "Orange Juice";
    echo $a->name . "<br />";
    echo $b->name . "<br />";
    echo $c->name . "<br />";


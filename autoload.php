<?php
  function my_autoload($class){
      if(preg_match('/\A\w+\z/',$class)){
          include 'class/'.$class. '.class.php';
      }
  }

    spl_autoload_register('my_autoload');

    $bike = new Bike;
    $bike->brand = "mountain";
    echo $bike->brand;


?>
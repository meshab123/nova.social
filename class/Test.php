<?php

/**
 * Created by PhpStorm.
 * User: owner
 * Date: 2/12/2018
 * Time: 12:11 PM
 */
class Test{
    var $firt_name;
    var $last_name;



}

$test1 = new Test;

$classes = get_declared_classes();
get_class_vars($stirng);
get_object_vars($object);
property_exists($mixed,$sting);
get_class_methods($mixed);
method_exists($mixed,$sting);
get_parent_class($sting);
is_subclass_of($mixed, $sting);
class_parents($mixed);
echo get_class($test1);

echo "Classes: " . implode(',',$classes)."<br />";

$class_names = ['product','student','Student','Test'];

foreach($class_names as $class_name){
    if(class_exists($class_names)){
        echo $class_names . " is declared class.<br />";
    }else{
        echo $class_names.  " is not a declared class. <br />";

    }
}
class product {
    public $name;
    public $color;
    public $price;

    public function __construct($args = []){
        $this->name = $args['name'] ? : NULL;
        $this->color = $args['color'] ? : NULL;
        $this->price = $args['price'] ? :NULL;
    }

    public function __destruct(){
      echo "Byi!";
    }
}

$shirt = new product(['name'=>'T-shirt','color'=>'blue','price'=>9.9]);
echo $shirt->color;


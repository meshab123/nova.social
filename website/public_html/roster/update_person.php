<?php
require_once '../../../class/person.php';

if(true){

    if(isset($_POST['name']) && $_POST['name']!=''){
        $name = $_POST['name'];
    }else{
        $name= '';
    }
    if(isset($_POST['time']) && $_POST['time']!=''){
        $time = $_POST['time'];
    }else {
        $time = '';
    }
    if(isset($_POST['hand']) && $_POST['hand']!=''){
        $hand = $_POST['hand'];
    }else {
        $hand = '';
    }
    if(isset($_POST['count']) && $_POST['count']!=''){
        $count = $_POST['count'];
    }else{
        $count = '';
    }
    if(isset($_POST['hand_raised']) && $_POST['hand_raised']!=''){
        $hand_raised = $_POST['hand_raised'];
    }else{
        $hand_raised = '';
    }
    if(isset($_POST['spend_rate']) && $_POST['spend_rate']!=''){
        $spend_rate = $_POST['spend_rate'];
    }else{
        $spend_rate = '';
    }

    insert_participant($name,$time,$hand,$count,$hand_raised,$spend_rate);
}

function insert_participant($name,$time,$hand,$count,$hand_raised,$spend_rate){
    $data = new person();

    $data->insert_person($name,$time,$hand,$count,$hand_raised,$spend_rate);


}

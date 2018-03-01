<?php

/**
 * Created by PhpStorm.
 * User: shemeles.abebe
 * Date: 12/5/2017
 * Time: 4:36 PM
 */
class person extends db_connection
{

    public function insert_person($name,$time,$hand,$count,$hand_raised,$spend_rate){
        $db_connect = new db_connection();
        $mysqli = mysqli_connect($db_connect->db_host,$db_connect->db_username,$db_connect->db_pass,$db_connect->db_name);
        if (mysqli_connect_errno()) { printf("Connect failed: %s\n", mysqli_connect_error()); exit(); }

        if($stmt = $mysqli->prepare("INSERT INTO participant(name,time,hand,count,hand_raised,spend_rate,) VALUES(?,?,?,?,?,?)")){
            $stmt->bind_param("ssiiii",$name,$time,$hand,$count,$hand_raised,$spend_rate);
            $stmt->execute();
        }
    }


}
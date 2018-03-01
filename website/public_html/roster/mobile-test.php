<?php
$GLOBALS['nova.socialxx']['attime'.time()] = "blah".time();
require_once '../../../class/Db-connection.php';

class Mobile extends Db_Connection{

    private $count;
    private $mysql;

    // require_once "sample.php";

//if(!isset($GLOBALS['nova.socialxx'])){
//  echo "creating nova.social for first time";

//}

    /*
    $ns = &$GLOBALS['nova.social'];

    //$ns['sample']['person'] =

    if(!isset($ns['sample']['testcount'])) $ns['sample']['testcount'] = 0;

    $ns['sample']['testcount'] = $ns['sample']['testcount']+1;
    */

   public function getTag(){
       $db_connect = new Db_Connection();
       $this->mysql = mysqli_connect("$db_connect->db_host", "$db_connect->db_username", "$db_connect->db_pass", "$db_connect->db_name");
       if (mysqli_connect_errno()) {
           printf("Connect failed: %s\n", mysqli_connect_error());
           exit();
       }

       $data = "SELECT * FROM globalvars
                ORDER BY varname";
       $result = mysqli_query($this->mysql, $data);
        if(!empty($result)){
            while ($row = mysqli_fetch_assoc($result)) {
              $name = $row['varname'];
              $time = $row['varvalue']['time'];
              $hand = $row['varvalue']['hand'];
                var_dump("data");
               var_dump($name);
                var_dump($time);
               var_dump($hand);
            }
        }
   }



    public function __set($property,$value){
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }

}

?>
<!doctype html>
<html lang="en">
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!---->
<!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!--    <link rel="stylesheet" href="css/mobile.css">-->
<!--    <link rel="stylesheet" href="css/main.css">-->
<!---->
<!--    <script src="js/jquery-3.2.1.js"></script>-->
<!--    <script src="js/jquery-ui.min.js"></script>-->
<!--    <script src="js/dropzone.min.js"></script>-->
<!--    <script src="js/bootstrap.min.js"></script>-->
<!--    <script src="js/modernizr.custom.js"></script>-->
<!--    <script src="js/sample.js"></script>-->
<!--    <script src="js/mobile.js"></script>-->
<!--</head>-->


<body>

<?php
echo json_encode($GLOBALS['nova.socialxx']);
?>

<div class="container main-content" style="margin-top:10px;">
    <div class="wel well-sm">

        <table class="table table-responsive table-bordered" style="width: 800px;">
            <thead>
            <th id="participant-queue">Queue</th>
            <th id="name-tag-content" ></th>
            <th id="participant-report">Report</th>
            </thead>
            <tbody>
            <td id="mobile-queue-list">

            </td>
            <td id="name-tag"></td>
            <td id="report-list">
                <input type="button" onclick="createMobileReport();" value="REPORT" style="position:absolute;top:100px;left:820px;height:30px; margin-top:10px; text-align: right;"/>

            </td>
            </tbody>
        </table>
    </div>

</div>
<script type="text/javascript">

</script>

</body>
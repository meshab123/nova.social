
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="js/jquery-3.2.1.js"></script>
    <link href="css/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="js/jquery-ui.css" />

    <script src="js/bootstrap.min.js"></script>
    <script src="js/speaking_queue.js"></script>



    <script src="js/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <script type="text/javascript">
        /*
         if(!isset($_COOKIE['person'])){
         $person = array();
         $_COOKIE['person'] = json_encode($person);
         }
         */

        <?php
        //            global $person;
        //            $person = array();


        echo "var person=[];".PHP_EOL; //FIXME use {} instead of [] and key is name
        // echo $person.PHP_EOL; //FIXME use {} instead of [] and key is name
        echo "var queue=[];".PHP_EOL;
        ?>

        console.log('commented draggable')
        $( function() {
            $( ".draggable" ).draggable();
        } );
    </script>
</head>
<body>

<div id="main">
    <div id="queue">
        <p style="font-weight:bold; font-size:20px; font-family: Roboto;">queue</p>

        <table class="table table-responsive table-bordered">
            <thead>
            <tr>
                <th style="text-align: center;font-weight:bold; font-size:20px; font-family: Roboto;">Name</th>
            </tr>
            </thead>
            <tbody id="add-queue-list" style="text-align: center;font-family: Roboto;">

            </tbody>
        </table>
    </div>
    <div id="participants">
        <p style="font-weight:bold; font-size:20px;">Participants</p>
        <table id="participant-list" class="table table-responsive table-bordered">
            <tbody id="participant" style="font-family: Roboto;">

            </tbody>
        </table>
        <button type="button" class="btn-default" id="add-name" style="text-align: center;" onclick="add_person(prompt('please enter participant name'));">Add</button>
        <button type="button" class="btn-default" id="delete-cookie" style="text-align: center;" onclick="delete_cookie();">Delete Cookie</button>
    </div>
    <div id="main-content">

    </div>

    <input type="button" onclick="stopAllTimers();" value="SILENCE" style="position:absolute;top:100px;left:650px;height:30px; margin-top:10px; text-align: right;"/>
    <input type="button" onclick="createReport();" value="REPORT" style="position:absolute;top:100px;left:820px;height:30px; margin-top:10px; text-align: right;"/>
    <div id="report_display" style="">
        <table class="table table-responsive table-bordered">
            <thead>
            <tr>
                <th style="font-weight:bold; font-size:20px; font-family: Roboto;">Name</th>
                <th style="font-weight:bold; font-size:20px; font-family: Roboto;">Time</th>
            </tr>
            </thead>
            <tbody id="add_person_time" style="font-family: Roboto;">

            </tbody>
        </table>

    </div>

</div>


<script>
    $( function() {
        $( ".draggable" ).draggable();
    } );
</script>

<script src="js/sample.js"></script>
<script type="text/javascript">
    $(".draggable").draggable();
    <!--    --><?php
    //    if(isset($_COOKIE['person'])){
    //        $person = json_decode($_COOKIE['person']);
    //        if(count($person) > 1) {
    //            $json_person = json_encode($person);
    //            foreach ($person as $pid => $p_data){
    //                echo "add_person('".$p_data['name']."');";
    //            }
    //        }
    //    }
    //
    //    ?>
    <?php
    //    function  create_person_cookie($cookie_value){
    //        $cookieName = 'participants';
    //        setcookie($cookieName, $cookie_value);
    //    }
    //
    //    $cookieName = 'participants';
    //    if(!isset($_COOKIE[$cookieName])) {
    //        print "Cookie with name" . $cookieName . " does not exist...";
    //    } else {
    //        print "Cookie with name " . $cookieName . " value is: " . $_COOKIE[$cookieName];
    //    }
    //?>


</script>
</body>
</html>










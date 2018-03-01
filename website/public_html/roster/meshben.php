<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="js/jquery-3.2.1.js"></script>
    <link href="css/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="js/jquery-ui.css" />

    <script src="js/bootstrap.min.js"></script>
    <script src="js/sample.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script type="text/javascript">
        /*
         if(!isset($_COOKIE['person'])){
         $person = array();
         $_COOKIE['person'] = json_encode($person);
         }
         */
        <?php
        echo "var person=[];".PHP_EOL; //FIXME use {} instead of [] and key is name
        echo "var queue=[];".PHP_EOL;
        ?>
    </script>

    <script>
        $( function() {
            $( ".draggable" ).draggable();
        } );
    </script>
</head>
<body>

<div id="main">
    <div id="queue">
        <p>queue</p>

        <table class="table table-responsive table-bordered">
            <thead>
            <tr>
                <th style="text-align: center;">Name</th>
            </tr>
            </thead>
            <tbody id="add-queue-list" style="text-align: center;">

            </tbody>
        </table>
    </div>
    <div id="participants">
        <p>Participants</p>
        <table id="participant-list" class="table table-responsive table-bordered">
            <tbody id="participant">

            </tbody>
        </table>
        <button type="button" class="btn-default" id="add-name" style="text-align: center;" onclick="add_person(prompt('please enter participant name'));">Add</button>
        <button type="button" class="btn-default" id="delete-cookie" style="text-align: center;" onclick="delete_cookie();">Delete Cookie</button>
    </div>
    <div id="main-content">
    </div>

    <input type="button" onclick="stopAllTimers();" value="WHEN SILENCE" style="position:absolute;top:100px;left:500px;height:500px;"/>
</div>

<!-- <script src="js/jquery-ui.min.js"></script> -->
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--<script>window.jQuery || document.write('<script src="js/jquery-3.2.1.min.js"><\/script>')</script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>-->
<!--<script src="js/jquery-ui.js"></script>-->
<!--<script src="js/bootstrap.js"></script>-->

<!--
<script>
    $( function() {
        $( ".draggable" ).draggable();
    } );
</script>
-->
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

</script>
</body>
</html>










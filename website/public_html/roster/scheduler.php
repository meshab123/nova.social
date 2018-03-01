<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <script src="js/jquery-1.11.2.min.js"></script>
    <link href="css/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="js/jquery-ui.css" />

    <script src="js/modernizr.custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
        /*
         if(!isset($_COOKIE['person'])){
         $person = array();
         $_COOKIE['person'] = json_encode($person);
         }
         */
        <?php
        echo "var person=[];".PHP_EOL;
        echo "var queue=[];".PHP_EOL;
        ?>
    </script>

    <script src="scheduler.js"></script>

    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <!-- <script src="js/jquery-ui.min.js"></script> -->

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
                <th>Name</th>

            </tr>
            </thead>
            <tbody id="add-queue-list">

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
</div>

<script type="text/javascript">
    $(".draggable").draggable();
    <?php
    if(isset($_COOKIE['person'])){
        $person = json_decode($_COOKIE['person']);
        if(count($person) > 1) {
            $json_person = json_encode($person);
            foreach ($person as $pid => $p_data){
                echo "add_person('".$p_data['name']."');";
            }
        }
    }

    ?>

</script>
</body>
</html>










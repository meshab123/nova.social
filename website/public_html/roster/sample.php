
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
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <script type="text/javascript">
        <?php
       echo "var person=[];".PHP_EOL; //FIXME use {} instead of [] and key is name
       // echo $person.PHP_EOL; //FIXME use {} instead of [] and key is name
        echo "var queue=[];".PHP_EOL;
        ?>
        $( function() {
            $( ".draggable" ).draggable();
        } );
    </script>
</head>
<body>

<div id="main">
    <div id="queue">
        <p style="font-weight:bold; font-size:20px; font-family: Roboto; background-color: lightgray;">QUEUE</p>

        <table class="table table-responsive table-bordered">

            <tbody id="add-queue-list" style="text-align: center;font-family: Roboto;">

            </tbody>
        </table>
    </div>
    <div id="list">
        <p style="font-weight:bold; font-size:20px; background-color: lightgray;">PARTICIPANTS</p>
        <table id="participant-display" class="table table-responsive table-bordered">
            <tbody id="participant-list" style="font-family: Roboto;">

            </tbody>
        </table>
        <button type="button" class="btn-default" id="add-name" style="text-align: center;" onclick="add_person(prompt('please enter participant name'));">Add</button>
        <button type="button" class="btn-default" id="delete-cookie" style="text-align: center;" onclick="delete_cookie();">Delete Cookie</button>
    </div>
    <div id="main-content">

    </div>

    <input type="button" class="btn-default" id="add-name" value="ADD PARTICIPANT" style="position:absolute;top:100px;left:500px;height:30px; margin-top:10px; text-align: right;" onclick="add_person(prompt('please enter participant name'));"/>
    <input type="button" class="btn-default" id="silence-button" onclick="stopAllTimers();changewhite(); silence_button();" value="SILENCE" style="position:absolute;top:100px;left:940px;height:30px; margin-top:10px; text-align: right;"/>
    <input type="button" class="btn-default"  value="REPORT" id="slide-report" onclick="slideReport();" style="position:absolute;top:100px;left:1440px;height:30px; margin-top:10px; text-align: right;"/>
    <div  class="toggle" id="report_display">
        <table class="table table-responsive table-bordered" id="report_list">
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

</script>
</body>
</html>










<?php

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
     <link rel="stylesheet" href="css/mobile.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/jquery-ui.min.js"></script>

     <script src="js/mobile.js"></script>
<!--    <script src="js/sample.js"></script>-->

    <script type="text/javascript">
        $( function() {
            $( ".draggable" ).draggable();
        } );
    </script>

</head>

<body>

<div class="container main-content" style="margin-top:10px;">
    <div class="wel well-sm">

        <table class="table table-responsive table-bordered" style="width: 600px; height:300px;">
            <thead>
            <th id="participant-queue">Queue</th>
            <th id="name-tag-content" ></th>
            <th id="participant-report"><input type="button" onclick="createMobileReport();" value="REPORT"/></th>
            </thead>
            <tbody>
            <td>
                <div id="mobile-queue-list">
                    <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th style="text-align: center;font-weight:bold; font-size:20px; font-family: Roboto;">Name</th>
                        </tr>
                        </thead>
                        <tbody id="add-mobile-queue-list" style="text-align: center;font-family: Roboto;">

                        </tbody>
                    </table>

                </div>

            </td>
            <td>
                <div id="name-tag">

                </div>
                <div id="hand-tag">

                </div>

            </td>

            <td>
                <div id="mobile-report-list">
                    <table class="table table-responsive table-bordered">
                        <thead>
                        <tr>
                            <th style="font-weight:bold; font-size:20px; font-family: Roboto;">Name</th>
                            <th style="font-weight:bold; font-size:20px; font-family: Roboto;">Time</th>
                        </tr>
                        </thead>
                        <tbody id="mobile_report" style="font-family: Roboto;">

                        </tbody>
                    </table>
                </div>
            </td>

            </tbody>
        </table>
    </div>

</div>
<script type="text/javascript">

</script>

</body>
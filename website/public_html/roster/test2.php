


<!doctype html>
<head>
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="js/jquery-ui.css" />

    <script src="js/dropzone.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <script src="js/modernizr.custom.js"></script>

    <script src="scheduler.js"></script>
    <link href="css/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/customer.css" />

    <style>
        #mainContent {
            border: 1px;
            width: 800px;
            height: 600px;
            position: absolute;
            left: 0px;
            top: 0px;
            margin-top:-100px;
        }

        .containtment {
            height: 600px;
            width: 600px;
            border: 1px solid;
        }

        .cube {
            width: 100px;
            height: 100px;
            background-color: blue;
            position: relative;
            display: block;
            margin: 1%;
        }

        #name-queue {
            border: 1px solid;
            position: absolute;
            width: 156px;
            height: auto;
            top: 100px;
            left: 0px;
            padding-left: 6px;
            padding-right: 5px;
        }
        #roster {
            border: 1px solid;
            position: absolute;
            width: 156px;
            height: auto;
            top: 349px;
            left: 0px;
            padding-left: 6px;
            padding-right: 5px;
            margin-right:5px;
        }

        .cube.ui-draggable-dragging {
            background: green;
        }

        .draggableHelper {
            width: 100px;
            height: 100px;
            background-color: blue;
            position: relative;
            display: block;
        }

        .makeMeDroppable {
            float: right;
            width: 200px;
            height: 300px;
            border: 1px solid #999;
            position: relative;
            overflow: hidden;
        }

    </style>
    <script type="text/javascript">
        $(document).ready(function() {

            $('.cube').draggable({
                containment: "parent",
                cursor: 'move',
                helper: myHelper,
            })

            function myHelper() {
                return '<div class="draggableHelper"></div>';
            }

            $('.makeMeDroppable').droppable({
                drop: handleDropEvent
            });

            function handleDropEvent(event, ui) {
                var draggable = ui.draggable;
                $(".makeMeDroppable").append("<div class='cube'></div>")
            }
        });
    </script>

    <body>
<div id="mainContent">
    <div id = "name-queue">
        <p>queue</p>
        <table class="table table-responsive table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody id="add-queue-list">

            </tbody>
        </table>
    </div>
    <div id="roster">
        <p>Participants</p>
        <table id="participant-list" class="table table-responsive table-bordered">
            <tbody id="participant">

            </tbody>
        </table>
        <button type="button" class="btn-default" id="add-name" style="text-align: center;" onclick="add_participant();">Add</button>
        <button type="button" class="btn-default" id="delete-cookie" style="text-align: center;" onclick="delete_cookie();">Delete Cookie</button>
    </div>
<div class="containtment">
    <div class="cube">
    </div>

    <div class ="makeMeDroppable">

    </div>
</div> <!--containtment-->
    </div>
   </body>
<!doctype html>
<head>
    <script src="js/jquery-1.11.2.min.js"></script>
    <link href="css/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/dropzone.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

    <script src="js/modernizr.custom.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="scheduler.js"></script>

    <link rel="stylesheet" href="css/jquery-ui.min.css" />
    <link rel="stylesheet" href="css/customer.css" />
    <script type="text/javascript">
        <?php
        if(isset($_COOKIE['participant'])){
            $participant = json_decode($_COOKIE['participant']);
            if(count($participant)>=1){
                $json_participant = json_encode($participant);
                echo "var participant = ".$json_participant.";\n";
            }
        } else {
            echo "var participant=[];\n";
        }
        ?>
        function add_participant() {
            var ary_name_and_time = set_name_and_time();
            var id = get_next_id();
			alert(id);
            participant[id] = {"name": ary_name_and_time[0], "time": ary_name_and_time[1]};
            set_cookie();
            // rewrite participant list
            // add nametag to main
        }

        function edit_participant(id, k, v) {

            set_cookie();
        }

        function delete_participant(id) {
            set_cookie();
        }

        function set_cookie() {
			$.cookie('participant', JSON.stringify(participant));

        }

        function set_name_and_time(current_name='', current_time=0) {
            var rtn = [];
            var name = prompt("Enter name : ", current_name);
            var time = prompt("Enter time : ", current_time);
            rtn.push(name);
            rtn.push(time);
            return rtn;
        }

        function get_next_id(){
            for (i = 0; i < 20000; i++) {
                if (i in participant) {
                    //key exists
                } else {
                    return i;
                }
            }
        }

    </script>
    <style>
        h3 {
            font-family: Roboto;
        }
        body{
            font-family: Roboto;
        }
        p{
            text-align: center;
            font-size: large;
        }
        button{
            text-align: center;
        }
        #main-content {
            border: 1px solid black;
            width: 800px;
            height: 600px;
            position: absolute;
            left: 5px;;
            top: 0px;
        }
        #draggable
            { width: 150px; height: 150px; padding: 0.5em; }
        #head {
            border: 1px solid;
            position: absolute;
            width: 800px;
            height: 100px;
            top: 0px;
            left: 0px;;
            text-align: center;
        }
        #name-queue {
            border: 1px solid;
            position: absolute;
            width: 400px;
            height: 250px;
            top: 100px;
            left: 0px;
            padding-left: 5px;
            padding-right: 5px;
        }
        #roster {
            border: 1px solid;
            position: absolute;
            width: 400px;
            height: 251px;
            top: 349px;
            left: 0px;
            padding-left: 5px;
            padding-right: 5px;
        }
        #content{
            border: 1px solid;
            position: absolute;
            width: 400px;
            height: 500px;
            top: 100px;
            left: 400px;
            padding-left: 5px;
        }

    </style>
</head>

<body>
<div id = "main-content">
    <div id = "head">
        <h3></h3>
    </div>
    <div id = "name-queue">
        <p>queue</p>
        <table class="table table-responsive table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Time/Second</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Bill Lenzy</td>
                <td>10.14</td>
            </tr>
            <tr>
                <td>Mary Morse</td>
                <td>3.15</td>
            </tr>
            <tr>
                <td>Judy David</td>
                <td>4.45</td>
            </tr>
                <td>Marcus Mozze</td>
                <td>4.45</td>
            </tbody>
        </table>
    </div>
    <div id="roster">
    <p>Participants</p>
      <table class="table table-responsive table-bordered">
            <tbody id="participant">

                <tr>
                     <td style="width: 100px;">
                        <button type="button" class="btn btn-sm btn-default edit-employee tip" id="edit-equipment-record" data-title="Edit equipment"  data-equipment="1"><em class="glyphicon glyphicon-pencil"></em></button>
                        <button type="button" class="btn btn-sm btn-danger delete-equipment tip" id="delete-equipment-record" data-equipment="1"><em class="glyphicon glyphicon-trash"></em></button>
                    </td>
                    <td>Lerry King</td>
                </tr>
                <tr>
                     <td style="width=100px;">
                        <button type="button" class="btn btn-sm btn-default edit-employee tip" id="edit-equipment-record" data-title="Edit equipment"  data-equipment="1"><em class="glyphicon glyphicon-pencil"></em></button>
                        <button type="button" class="btn btn-sm btn-danger delete-equipment tip" id="delete-equipment-record" data-equipment="1"><em class="glyphicon glyphicon-trash"></em></button>
                    </td>
                    <td>Mark Lenzy</td>

                </tr>
            </tbody>
        </tr>
      </table>
            <button type="button" class="btn-default" id="add-name" style="text-align: center;" onclick="add_participant();">Add</button>
    </div>
    <div id = "content">
        <div id="draggable" class="ui-widget-content">
            <p>draggable</p>
        </div>
    </div>
</div>
</body>










<!doctype html>
<html lang="en">
<head>
    <script src="js/jquery-1.11.2.min.js"></script>
    <link href="css/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/dropzone.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

    <script src="js/modernizr.custom.js"></script>
    <script src="js/jquery-ui.min.js"></script>


    <link rel="stylesheet" href="css/jquery-ui.min.css" />
    <link rel="stylesheet" href="css/customer.css" />
    <script type="text/javascript">
        var name;
        var time;
        var participant = {};
        participant['MC'] = 0;

        var hand = {};
        hand['MC'] = 0;


        <?php
        if (isset($_COOKIE['participant'])) {
            $participant = json_decode($_COOKIE['participant']);
            if(count($participant) > 1) {
                $json_participant = json_encode($participant);
                echo "participant = ".$json_participant.";\n";
            }
        }
        if (isset($_COOKIE['hand'])) {
            $hand = json_decode($_COOKIE['hand']);
            if(count($hand) > 1) {
                $json_hand = json_encode($hand);
                echo "participant = ".$json_hand.";\n";
            }
        }
        ?>

        function add_participant() {
            var ary_name_and_time = set_name_and_time();
            var name='';
            var time=0;
            name = ary_name_and_time[0];
            time = ary_name_and_time[1];
            participant[name] = time;
            hand[name] = 0;
            set_cookie();
            create_nametag(name);
        }

        function delete_participant(id) {
            //remove card
            set_cookie();
        }

        function set_cookie() {
            $.cookie('participant', JSON.stringify(participant));
            $.cookie('hand', JSON.stringify(participant));
        }

        function delete_cookie() {
            $.cookie('participant', null, { path: '/' });
            $.cookie('hand', null, { path: '/' });
            alert("cookie gone");
        }

        function set_name_and_time(current_name='', current_time=0) {
            var rtn = [];
            name = prompt("Enter name : ", current_name);
            time = prompt("Enter time : ", current_time);
            rtn.push(name);
            rtn.push(time);
            return rtn;
        }

        function initialize_all_timers() {
            for (var i = 0; i < participant.length; i++) {
                participant[i] = 0;
            }
        }

        function fancyTimeFormat(time) {
            // Hours, minutes and seconds
            var hrs = ~~(time / 3600);
            var mins = ~~((time % 3600) / 60);
            var secs = time % 60;

            // Output like "1:01" or "4:03:59" or "123:03:59"
            var ret = "";

            if (hrs > 0) {
                ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
            }

            ret += "" + mins + ":" + (secs < 10 ? "0" : "");
            ret += "" + secs;
            return ret;
        }

        function start_timer(id) {
            xs[id]=setTimeout("start_timer("+id+")", 1000);
            counters[id] = counters[id] + 1;
            document.getElementById("but"+id).value = counters[id];

            if (counters[id] > 10000) {
                counters[id] = 0;
            }

        }

        function stop_timer(id) {
            clearTimeout(xs[id]);
        }

        function create_nametag(name) {

            var nameTagTr = '';
            nameTagTr += '<div id="name-tag-'+ name +'">' +
                '<table class="table-responsive table-bordered">' +
                    '<tbody>' +
                        '<tr>' +
                            '<td colspan="2" rowspan="2" id="participant-name"></td>' +
                            '<td id="registered-time"></td>' +
                        '</tr>' +
                        '<tr>' +
                            '<td id="image-tag"><em class="glyphicon glyphicon-hand-up" onclick="delete_nametag(\''+ name +'\');"></em></td>' +
                        '</tr>' +
                    '</tbody>' +
                '</table>' +
            '</div>';
            $( "#draggable" ).append(nameTagTr);
        }

        function delete_nametag(name) {
            var item = "#name-tag-"+name+"";
            alert(item);
            $( "#draggable" ).remove(item);
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
            border: 1px;
            width: 800px;
            height: 600px;
            position: absolute;
            left: 0px;
            top: 0px;
            margin-top:-100px;
        }
        #draggable
            { width: 150px; height: 300px; padding: 0.5em; }
        /*#head {*/
            /*border: 1px solid;*/
            /*position: absolute;*/
            /*width: 800px;*/
            /*height: 100px;*/
            /*top: 0px;*/
            /*left: 0px;;*/
            /*text-align: center;*/
        /*}*/
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
        #content{
            border: 1px solid;
            position: absolute;
            width: 800px;
            height: 800px;
            top: 100px;
            left: 400px;
            padding-left: -0px;
            margin-left:-244px;
        }
        #name-tag {
            border: 0px solid;
            position: relative;
            width: 80px;
            height: 40px;
            top: 100px;
            left: 5px;
            padding-left: 0px;
            margin-left:-5px;
        }
         #mc {
             border: 0px solid;
             position: absolute;
             width: 80px;
             height: 40px;
             top: 100px;
             left: 5px;
             padding-left: 0px;
             margin-left:-5px;
         }

        .glyphicon-hand-up {
            position:relative;
            top:1px;
            display:inline-block;
        }
        .glyphicon-hand-dwon {
            position:relative;
            top:1px;
            display:inline-block;
        }

        #image-tag {
            text-align: center;
        }
    </style>
</head>

<body onload="initialize_all_timers();">
<div id = "main-content">
    <div id = "name-queue">
        <p>queue</p>
        <table class="table table-responsive table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Time</th>
            </tr>
            </thead>
            <tbody id="queue">
            <!-- WHEN HAND IS RAISED, QUEUE WILL BE REBUILT -->
            </tbody>
        </table>
    </div>
    <div id="roster">
    <p>Participants</p>
      <table class="table table-responsive table-bordered">
            <tbody id="participant">
            <!-- WHEN ROSTER IS ADDED / EDITED / DELETED FROM, PARTICIPANT WILL BE REBUILT -->
            </tbody>
        </tr>
      </table>
        <button type="button" class="btn-default" id="add-name" style="text-align: center;" onclick="add_participant();">Add</button>
        <button type="button" class="btn-default" id="delete-cookie" style="text-align: center;" onclick="delete_cookie();">Delete Cookie</button>
    </div>
    <div id = "content">
        <div id="draggable" class="ui-widget-content" style="width:800px; height:1000px">
            <p>draggable</p>
        </div>

        <div id="mc">
            <table class="table-responsive table-bordered">
                <tbody>
                <tr>
                    <td colspan="2" rowspan="" id="participant-name"></td>
                </tr>
                <tr>
                    <td colspan="" rowspan="" id="registered-time"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
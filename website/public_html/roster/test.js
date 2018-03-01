var person=[];
var queue=[];

$(document).ready(function(){
    add_person("Kris");
    start_timer(0);
    //add_person("Bill"); // error check

    // this will pull from php reading cookie, hardcoded for now
    /*
     for (var i=0, len=person.length; i<len; i++) {                          // iterate through all people
     reset_time(i);                                                      // reset times
     person[i].hand = 0;                                                 // deactivate all hands

     }
     */

    $("#add-name").on('click',function(){
            add_person(prompt('please enter name',''));
    });

    function add_person(name) {
        var p = {};
        for (var i=0, len=person.length; i<len; i++) {                      // iterate through all people
            if (person[i].name == name || name == '') {
                alert("Name already exists or is blank, try again");
                var new_name = prompt("Please enter name", "");
                add_person(new_name);
                return;
            }
        }
        p.name = name;
        p.timer = null;                                                     // object to hold timer iterator
        p.time = 0;                                                         // time in seconds (integer)
        p.timer_display = "00:00";
        p.hand = 0;                                                         // 0 = Hand Not Raised; 1 = Hand Raised
        p.hand_raised = 0;                                                  // time when hand raised, to determine order if same time
        person.push(p);
        create_nametag(name);
    }

    function reset_time(pid) {
        person[pid].time = 0;
        person[pid].timer_display = "00:00";
    }

    function stop_timer(pid) {
        clearInterval(person[pid].timer);
    }

    function start_timer(pid) {
        person[pid].timer = setInterval(increment_timer, 1000, pid);
    }

    function increment_timer(pid) {
        person[pid].time++;
        person[pid].timer_display = formatTime(person[pid].time);
    }

    function activate_hand(pid) {
        person[pid].hand = 1;
    }

    function deactivate_hand(pid) {
        person[pid].hand = 0;
    }

    function create_nametag(name) {
        person.sort();
        console.log("sorted array");
        console.log(person);
        var i,k = 0;
        for(i = 0; i < person.length; i++){
            k = person[i];
            console.log("k");
            console.log(k);
            var p_list, namecards = '';

            p_list +=
                '<tr>' +
                '<td style="width: 120px;">' +
                '<button type="button" class="btn btn-sm btn-default edit-name tip" id="edit-name" data-title="Edit name"  data-name="1"><em class="glyphicon glyphicon-pencil"></em></button>' +
                '<button type="button" class="btn btn-sm btn-danger delete-name tip" id="delete-name" data-name="1"><em class="glyphicon glyphicon-trash"></em></button>' +
                '</td>' +
                '<td>' + k['name'] + '</td>' +
                '</tr>';

            namecards +=
                '<table id="name-tag" class="table table-responsive table-bordered">'+
                '<tbody>'+
                '<tr>'+
                '<td id="participant-name" class="table-data">'+ k['name'] +'</td>'+
                '<td id="registered-time">'+k['timer']+'</td>'+
                '</tr>'+
                '<tr>'+
                '<td id="speak-icon">' + '<em class="glyphicon glyphicon-option-horizontal" id="speak"></em>'  +'</td>'+
                '<td id="image-tag"><em class="glyphicon glyphicon-hand-up" onclick="delete_nametag(\''+ k['name'] +'\');"></em></td>' +
                '</tr>'+
                '</tbody>'+
                '</table>'+
                '<br>'+
                '<br>';

        }

        document.getElementById('participant').innerHTML = p_list;
        document.getElementById('draggable').innerHTML = namecards;


//            var nameTagTr = '';
//            nameTagTr += '<div id="name-tag-'+ name +'">' +
//                '<table class="table-responsive table-bordered">' +
//                '<tbody>' +
//                '<tr>' +
//                '<td colspan="2" rowspan="2" id="participant-name"></td>' +
//                '<td id="registered-time"></td>' +
//                '</tr>' +
//                '<tr>' +
//                '<td id="image-tag"><em class="glyphicon glyphicon-hand-up" onclick="delete_nametag(\''+ name +'\');"></em></td>' +
//                '</tr>' +
//                '</tbody>' +
//                '</table>' +
//                '</div>';
//            $( "#draggable" ).append(nameTagTr);
    }

    function delete_nametag(name) {
        var item = "#name-tag-"+name+"";
        alert(item);
        $( "#draggable" ).remove(item);
    }


    function people() {
        console.log(person);
    }

    function formatTime(seconds) {
        var h = Math.floor(seconds / 3600);
        var m = Math.floor((seconds % 3600) / 60);
        var s = seconds % 60;
        return [h, m > 9 ? m : '0' + m, s > 9 ? s : '0' + s].filter(s => s).join(':');
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

    function pad ( val ) {
        return val > 9 ? val : "0" + val;
    }

});
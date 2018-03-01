
var dt = .02;
var aString = "xx";

//edit participant array and DOM
function edit_clicked(name){
    var updatedName = prompt("Please enter name", "");
    for(listIndex in person){

        if(person[listIndex].name == name){

            person[listIndex].name = updatedName;
            set_cookie();
            alert("name found " + person[listIndex].name);
            console.log("person");
            console.log(person);

            $('#participant-id-'+ name).empty();
            $('#person-tag-'+ name).empty();

            $('#participant-id-'+ name).append(person[x].name);
            $('#person-tag-'+ name).append(person[x].name);
        }
    }
}

//delete from person array and DOM
function delete_clicked(name){
    var pid = get_person_id(name);
    for(listIndex in person){
        if(pid == person[listIndex].pid){
            person.splice(listIndex,1);
            $('#participant-name-'+ name).remove();
            $('#name-card-'+name).remove();
            $('#handbull-icon-'+name).remove();
        }
    }
}


function add_person(name){

    create_nametag(name);
    add_participant(pid=get_next_id(),name,time=0,hand=0,count=0,hand_raised=0,spendRate=0);
    //console.log(person);
}

function add_participant(name,time,hand, count,hand_raised,spendRate){
    $.ajax({
        type:'POST',
        dataType:'html',
        url: 'update_person.php',
        data: {
            name:name,
            time:time,
            hand:hand,
            count:count,
            hand_raised:hand_raised,
            spend_rate:spendRate
        },

        success:function(data){
            console.log(data);
            console.log(data);
        }
    });
}

//function createCookie(){
//    var cookieValue = JSON.stringify(person,true);
//    $.cookie( 'participants' , cookieValue);
//}
//
//function createQueueCookie(){
//    var cookieValue = JSON.stringify(queue, true);
//    $.cookie('queue',cookieValue);
//
//    // alert(cookieValue);
//}


//function delete_cookie() {
//    $.cookie('participants', null, { path: '/' });
//    alert("cookie gone");
//}



function get_person_id(name) {
    for (var i=0, len=person.length; i<len; i++) {                      // iterate through all people
        if (person[i].name == name) {
            return i;
        }
    }
}



function sortQueue(){
    var length = queue.length;
    if (length >= 2) {
        //sort two or more participant is waiting in the queue array
        queue.sort(function (a, b) {
            //var timeA = new Date(a.hand_raised), timeB = new Date(b.hand_raised);
            //return timeA - timeB; //sort by time ascending
            if(a.time < b.time) return -1;
            if(a.time > b.time) return 1;
            return 0;
        });
    }
}

function sortReport(){
    //var length = queue.length;
    //if (length >= 2) {
    //sort two or more participant is waiting in the queue array
    person.sort(function (a, b) {
        if(a.time > b.time) return -1;
        if(a.time < b.time) return 1;
        return 0;
    });
    // }
}


function push_to_queue(name) {
    var pid = get_person_id(name);
    for(var i = 0; i < queue.length; i++){
        if(queue[i].name == name || name==''){
            alert("Name already exist in the queue list, try again");
            return;

        }
    }

    sortQueue();
    queue.push(person[pid]);

    console.log("queue Array");
    console.log(queue);

    queue.sort(function (a, b) {
        var timeA = new Date(a.hand_raised), timeB = new Date(b.hand_raised);
        return timeA - timeB; //sort by time ascending
    });
    //redrawQueue();
    //createQueueCookie();
}

//remove from the queue if there exist one item in the queue
function remove_from_queue(name){
    var  pid = get_person_id(name);
    for(listIndex in queue){
        if(pid == queue[listIndex].pid){
            //console.log("Splicing at "+listIndex);
            queue.splice(listIndex,1);
           // createQueueCookie();
            break;
        }else{
        }
    }
    //redrawQueue();
}

function redrawQueue(){
    var html = '';
    for(listIndex in queue){
        html += '<tr><td id="queue-list-' + queue[listIndex].name + '" style="font-weight:bold; font-size:20px;">' + queue[listIndex].name + '</td></tr>';
    }
    document.getElementById('add-queue-list').innerHTML = html;

}

function createReport(){
    var report = '';
    sortReport();
    for(listIndex in person){
        var t = person[listIndex].time
        var timeString = Math.floor(t/60)+":"+Math.floor(t%60);
        //createCookie();

        report += '<tr style="font-weight:bold; font-size:20px; font-family: Roboto;">' +
            '<td id="report-list-' + person[listIndex].name + '">' + person[listIndex].name + '</td>' +
            '<td id="report-list-' + person[listIndex].time + '">' + timeString + '</td>' +
            '</tr>';
        document.getElementById('add_person_time').innerHTML = report;

    }
}



function stopAllTimers(){
    for(i in person){
        person[i].spendRate = 0;
        //createCookie();
    }
}

//Name tag activation when the participant is in the queue or not in the queue
function name_click(name){
    console.log("name_click "+name);
    //var pid = get_person_id(name);
    activate_nametag(name);
    stopAllTimers();
    getPerson(name).spendRate = 1;

    deactivatePersonHand(name); //hand status updated to 0 and

    // deactivate_nametags(name);
    remove_from_queue(name);
    //createCookie();
}


function deactivatePersonHand(name){
    var pid = get_person_id(name);
    $('#hand-tag-' + name).html('<i class="fa fa-hand-rock-o" aria-hidden="true"></i> ');
    // $('#hand-tag-' + name).css('background-color', 'gray');
    person[pid]['hand'] = 0;
    //getPerson(name).spendRate = 0;
   // createCookie();
}

function activate_nametag(name){
    var pid = get_person_id(name);
    person[pid]['name_status'] = 1; //currently speaking.....
    $('#person-tag-' + name).css('background-color','lightgreen');
    $('#time-tag-' + name).css('background-color','lightgreen');
    $('#oot-tag-' + name).css('background-color','lightgreen');
    $('#hand-tag-' + name).css('background-color','lightgreen');
}


function deactivate_nametags(name){
    var pid = get_person_id(name);
    // for(var i = 0; i < person.length; i++){
    if(name!=person[i]['name']){
        $('#person-tag-' + person[i]['name']).css('background-color','gray');
        // stop_timer(person[pid]);
    }
    //}
}

function getPerson(name){
    for(x in person){
        if(person[x].name == name) return person[x];
        //createCookie();
    }
    throw 'No person of name: '+name;
}


function timer_click(name){
    var pid = get_person_id(name);
    $('#person-tag-' + person[pid]['name']).css('background-color','white');
    $('#oot-tag-' + person[pid]['name']).css('background-color','white');
    $('#time-tag-' + person[pid]['name']).css('background-color','white');
    $('#hand-tag-' + person[pid]['name']).css('background-color','white');
    stopAllTimers();

}

function oot_clicked(name) {
    var currentName = getPerson(name);
    console.log("Name tag");
    console.log(currentName);
    //console.log("oot_clicked "+name);
    //var pid = get_person_id(name);
    //outOfOrdercolor(name);
    //stopAllTimers();
    //getPerson(name).spendRate = 2;

    verifyInterrupt(name);
}

/*SA: time spend rate will be incremented based on the number of interrupt and name tag color changed as well. First time interrupt the rate is 2 and name tag filled with
 orange color. Second time interrupt the rate is 4 and name tag is  filled with yellow. Third time interrupt, the rate is 6 and name tag is filled with Red.

 */

function verifyInterrupt(name) {
    if(getPerson(name).count >=4){
        flagRed(name);
        stopAllTimers(name);
        disableTag(name);
        //createCookie();
    }
    else if(getPerson(name).count >=3){
        flagRed(name);
        stopAllTimers();
        getPerson(name).spendRate = 6;
        //createCookie();
    }

    else if(getPerson(name).count >=2){
        flagyellow(name);
        stopAllTimers();
        getPerson(name).spendRate = 4;
        getPerson(name).count = getPerson(name).count + 1;
        //createCookie();
    }

    else {
        flagOrange(name);
        stopAllTimers();
        getPerson(name).spendRate = 2;
        getPerson(name).count = getPerson(name).count + 1;
        //createCookie();
    }

}

function flagRed(name){
    $('#hand-tag-' + name).css('background-color', 'red');
    $('#person-tag-' + name).css('background-color', 'red');
    $('#time-tag-' + name).css('background-color', 'red');
    $('#oot-tag-' + name).css('background-color', 'red');
}

function disableTag(name){
    $('#hand-tag-' + name).prop("disabled", true);
    $('#person-tag-' + name).prop("disabled", true);
    $('#time-tag-' + name).prop("disabled", true);
    $('#oot-tag-' + name).prop("disabled", true);
}

function flagyellow(name){
    $('#hand-tag-' + name).css('background-color', 'yellow');
    $('#person-tag-' + name).css('background-color', 'yellow');
    $('#time-tag-' + name).css('background-color', 'yellow');
    $('#oot-tag-' + name).css('background-color', 'yellow');
}

function flagOrange(name){
    $('#person-tag-' + name).css('background-color','orange');
    $('#time-tag-' + name).css('background-color','orange');
    $('#oot-tag-' + name).css('background-color','orange');
    $('#hand-tag-' + name).css('background-color','orange');
}


function hand_clicked(name){
    console.log("hand_clicked "+name);
    var pid = get_person_id(name);
    if (person[pid]['hand'] == 0) {
        person[pid]['hand_raised'] = person[pid]['time'];
        activate_hand(pid);

        $('#hand-tag-' + name).html('<i class="fa fa-hand-paper-o" aria-hidden="true"></i>');
        $('#hand-tag-' + name).css('background-color', 'lightgreen');
        $('#person-tag-' + name).css('background-color', 'white');
        $('#time-tag-' + name).css('background-color', 'white');
        $('#oot-tag-' + name).css('background-color', 'white');
        push_to_queue(name);
        //createCookie();

        // alert('the hand -not raised- clicked was ' + name);
    } else {
        deactivate_hand(pid );

        $('#hand-tag-' + name).html('<i class="fa fa-hand-rock-o" aria-hidden="true"></i>');
        $('#hand-tag-' + name).css('background-color', 'white');
        remove_from_queue(name);
        //createCookie();
    }
}

function activate_hand(pid) {
    person[pid]['hand']= 1;
    createCookie();
}

function deactivate_hand(pid) {
    person[pid]['hand'] = 0;
    //createCookie();
}

function create_nametag(name) {
    //person.sort();
    //console.log("sorted array");
    //console.log(person);
    var i, k = 0;
    for (i = 0; i < person.length; i++) {
        k = person[i];
        //console.log("k");
        //console.log(k);
        var p_list, namecards = '';

        p_list +=
            '<div id="participant-'+k['name']+'">'+
            '<tr id="participant-name-'+k['name']+'" style="font-weight:bold; font-size:16px; font-family: Roboto;">' +
            '<td class="edit-participant" id="edit-participant-'+ k['name'] +'"><em class="glyphicon glyphicon-pencil"></em></td>' +
            '<td class="delete-participant" id="delete-participant-'+k['name']+'"><em class="glyphicon glyphicon-trash"></em></td>' +
            '<td id="participant-id-'+k['name']+'">' + k['name'] + '</td>' +
            '</tr>'+
            '</div>';

        namecards +=
            '<div class="draggable ui-draggable-handle" id="'+k['name']+'">' +
            '<table id="person-tag" class="table table-responsive table-bordered name-tag">' +
            '<tbody id="name-badge-'+k['name']+'" style="font-weight:bold; font-size:20px; font-family: Roboto;" disabled="disabled">'+
            '<tr id="name-card-'+k['name']+'">' +
            '<td rowspan="2" style="background-color:#cccccc; max-width:10px"><img style="padding:0; margin:0; border:0; width:10 px;" src="../../public_html/media/images/blank.gif" width="10 px"/></td>' +
            '<td class="person-tag" id="person-tag-'+ k['name'] +'">'+ k['name'] +'</td>' +
            '<td class="timer" id="time-tag-'+ k['name'] +'">' + k['timer_display'] + '</td>' +
            '</tr>' +
            '<tr id="handbull-icon-'+k['name']+'">' +
            '<td class="oot-tag" id="oot-tag-'+ k['name'] +'"><i class="fa fa-bullhorn" aria-hidden="true""> </td>' +
            '<td class="hand-tag" id="hand-tag-'+ k['name'] +'"><i class="fa fa-hand-rock-o" aria-hidden="true"></i></td>' +
            '</tr>' +
            '</tbody>'+
            '</table>' +
            '</div>';
    }

    document.getElementById('participant').innerHTML = p_list;

    $('#main-content').append(namecards);

    $('#'+k['name']).draggable();

    $('#person-tag-'+k['name']).on('click', function() {
        name_click(k['name']);
    });

    $('#time-tag-'+k['name']).on('click', function() {
        timer_click(k['name']);
    });

    $('#oot-tag-'+k['name']).on('click', function() {
        oot_clicked(k['name']);
    });

    $('#hand-tag-'+k['name']).on('click', function() {
        hand_clicked(k['name']);
    });

    $('#edit-participant-'+k['name']).on('click', function() {
        edit_clicked(k['name']);
    });

    $('#delete-participant-'+k['name']).on('click', function() {
        delete_clicked(k['name'])
    });


}


var firstRun = true;

$(document).ready(function() {
    if (firstRun) {
        firstRun = false;

        aString += "x";
        //console.log(aString);
        if (aString.length > 3) throw 'jquery bug is running ready more than4 once. astring=' + aString;

        $(".draggable").draggable();

        setInterval(function () { //1 timer for everyone
            for (x in person) {
                person[x].time += dt * person[x].spendRate;
                if (person[x].time == 0 || person[x].spendRate != 0) { //update display of person's time
                    var id = 'time-tag-' + person[x].name;
                    var t = person[x].time;
                    //  var timeString = Math.floor(t/60)+":"+Math.floor(t%60)+":"+(t%1);
                    var fractionStr = "" + (t % 1) + "00";
                    //fractionStr = fractionStr.substring(2,4);
                    //var timeString = Math.floor(t/60)+":"+Math.floor(t%60)+":"+fractionStr;
                    var timeString = Math.floor(t / 60) + ":" + Math.floor(t % 60);
                    document.getElementById(id).innerHTML = timeString;
                }
                // sortQueue();
                redrawQueue();
            }
        }, Math.round(dt * 1000));

        for (i = 0; i <= 0; i++) add_person("Kris");

    }
    // createCookie();
});

//$(document).ready(function(){console.log('docready')});
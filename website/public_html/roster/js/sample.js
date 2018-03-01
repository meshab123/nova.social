
var dt = .02;
var aString = "xx";

function edit_clicked(name){
    var pid = get_person_id(name);

    var updatedName = prompt("Please enter name", "");
    if(updatedName!==null) {
        for (var x in person) {
            if (person[x].pid == pid) {
                person[x].name = updatedName;
                createCookie();
                $("#update-participant-"+ name).empty();

                $('#person-tag-'+ pid).empty();

                //$('#time-tag-'+name).append(formatString);
                $('#update-participant-'+ name).append( person[x].name);
                $('#person-tag-'+ pid).append( person[x].name);
                break;
            }
        }
    }
}



//Delete from DOM and person array
//function delete_clicked(name){
//    var pid = get_person_id(name);
//   // var pname = get_person_by_name(pid);
//    //alert(pid + " " + pname);
//    $('#current-row-'+ pid).remove();
//    $('#name-tag-'+ pid).remove();
//    $('#display-report-'+ pid).remove();
//      remove_from_queue(name);
//
//
//   // reomve_from_report(name);
//
//    for(listIndex in person){
//        if(person[listIndex].pid===pid){
//            person.splice(listIndex,1);
//           // remove_from_queue(pname);
//            break;
//        }
//    }
//}

function add_person(name){
    var p = {};
    for (var i=0; i<person.length; i++){
        if (person[i].name == name || name == '') {
            return;
        }
    }
    p.pid = get_next_id();
    p.name = name;
    //p.timer = null;                                                     // object to hold timer iterator
    p.time = 0;                                                         // time in seconds (integer)
    p.timer_display = '00:00:00';
    p.hand = 0;

    p.hand_raised = 0;                                                  // time when hand raised, to determine order if same time
    p.name_status = 0; //to hold the current speaker: color green name_status change to one otherwise name_status = 0;
    //p.extra_time = 0;
    p.spendRate = 0; //0 when not spending time. 1 when talking normally. 2 when interrupt. or any number for future expansion.
    person.push(p);
    create_nametag(name);
    createCookie();
    console.log("personData");
    console.log(person);
}

function createCookie(){
    var cookieValue = JSON.stringify(person,true);
    $.cookie( 'participants' , cookieValue);
}


function delete_cookie() {
    $.cookie('participants', null, { path: '/' });
    alert("cookie gone");
}

function get_next_id(){
    for (i = 0; i < 20000; i++) {
        if (i in person) {
            console.log('key ' + i + 'exists in participant');
        } else {
            return i;
        }
    }
}

//loop through a person object and return the id of the person
function get_person_id(name) {
    for (var i=0, len=person.length; i<len; i++) {
        if (person[i].name == name) {
            return i;
        }
    }
}

function get_person_by_name(pid){
    var len = person.length;
    for(var i=0; i<len; i++){
        if(person[i].pid== pid){
            return person[i].name;
        }
    }
}

/**
 * SA: sort two or more participants in the queue in desending order
 */
function sortQueue(){
    var length = queue.length;
    if (length >= 2) {
        queue.sort(function (a, b) {
            if(a.time < b.time) return -1;
            if(a.time > b.time) return 1;
            return 0;
        });
    }
}

function sortReport(){
    person.sort(function (a, b) {
        if(a.time > b.time) return -1;
        if(a.time < b.time) return 1;
        return 0;
    });
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

//SA:remove from the queue if there exist one item in the queue
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

function reomve_from_report(name){
    var  pid = get_person_id(name);
    for(listIndex in person){
        if(pid == person[listIndex].pid){
            //console.log("Splicing at "+listIndex);
            person.splice(listIndex,1);
            // createQueueCookie();
            break;
        }else{
        }
    }
}

function redrawQueue(){
    var html = '';
    for(listIndex in queue){
        html += '<tr><td id="queue-list-' + queue[listIndex].pid + '" style="font-weight:bold; font-size:20px;"><div class="fixedsize">' + queue[listIndex].name + '</div></td></tr>';
    }
    document.getElementById('add-queue-list').innerHTML = html;

}



function stopAllTimers(){
    for(i in person){
        person[i].spendRate = 0;
        //    createCookie();
    }
}



function silence_button(){
    $("#silence-button").css('background-color', 'lightgreen');
}


//Name tag activation when the participant is in the queue or not in the queue
function name_click(name){
    console.log("name_click "+name);
    var pid = get_person_id(name);
    activate_nametag(name);
    stopAllTimers();
    getPerson(name).spendRate = 1;

    deactivatePersonHand(name); //hand status updated to 0 and

    $("#silence-button").css('background-color', 'white');

    // deactivate_nametags(name);
    remove_from_queue(name);
    //createCookie();
}


function deactivatePersonHand(name){
    var pid = get_person_id(name);
    $('#hand-tag-' + pid).html('<i class="fa fa-hand-rock-o" aria-hidden="true"></i> ');
    // $('#hand-tag-' + name).css('background-color', 'gray');
    person[pid]['hand'] = 0;
    //getPerson(name).spendRate = 0;
    //createCookie();
}

function activate_nametag(name){
    var pid = get_person_id(name);
    person[pid]['name_status'] = 1; //currently speaking.....
    $('#person-tag-' + pid).css('background-color','lightgreen');
    $('#time-tag-' + pid).css('background-color','lightgreen');
    $('#oot-tag-' + pid).css('background-color','lightgreen');
    $('#hand-tag-' + pid).css('background-color','lightgreen');
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
        // createCookie();
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
    verifayInterrupt(name);

}

function verifayInterrupt(name){
    stopAllTimers();
    getPerson(name).spendRate = 2;
}

function personShouldBeColor(pers){
    if(pers.spendRate > 1) return 'orange';
    if(pers.spendRate > 0) return 'lightgreen';
    //if(pers.hand > 0) return 'green';
    return 'white';
}

function personsHandShouldBeColor(pers){
    if(pers.spendRate > 1) return 'orange';
    if(pers.spendRate > 0) return 'lightgreen';
   // if(pers.hand > 0) return 'lightgreen';
    return 'white';
}

function setAllPersonsColors(){
    for(i in person){
        var color = personShouldBeColor(person[i]);
        var handColor = personsHandShouldBeColor(person[i]);
        $('#person-tag-' + person[i]['pid']).css('background-color',color);
        $('#oot-tag-' + person[i]['pid']).css('background-color',color);
        $('#time-tag-' + person[i]['pid']).css('background-color',color);
        $('#hand-tag-' + person[i]['pid']).css('background-color',handColor);
    }
}

function changewhite(){
    for(i in person){
        $('#person-tag-' + person[i]['pid']).css('background-color','white');
        $('#oot-tag-' + person[i]['pid']).css('background-color','white');
        $('#time-tag-' + person[i]['pid']).css('background-color','white');
        $('#hand-tag-' + person[i]['pid']).css('background-color','white');

    }
}


function hand_clicked(name){

    var pid = get_person_id(name);
    if (person[pid]['hand'] == 0) {
        person[pid]['hand_raised'] = person[pid]['time'];
        activate_hand(pid);
        console.log("hand_tag" + pid);

        $('#hand-tag-' + pid).html('<i class="fa fa-hand-paper-o" aria-hidden="true"></i>');
       // $('#hand-tag-' + name).css('background-color', 'lightgreen');
        $('#person-tag-' + pid).css('background-color', 'white');
        $('#time-tag-' + pid).css('background-color', 'white');
        $('#oot-tag-' + pid).css('background-color', 'white');
        push_to_queue(name);
        // createCookie();

        // alert('the hand -not raised- clicked was ' + name);
    } else {
        deactivate_hand(pid );

        $('#hand-tag-' + pid).html('<i class="fa fa-hand-rock-o" aria-hidden="true"></i>');
        $('#hand-tag-' + pid).css('background-color', 'white');
        remove_from_queue(name);
        createCookie();
    }
}

function activate_hand(pid) {
    person[pid]['hand']= 1;
    createCookie();
}

function deactivate_hand(pid) {
    person[pid]['hand'] = 0;
    createCookie();
}

function slideReport(){

    $("#report_display").toggleClass("hidden unhidden");

    //$("#slide-report").toggleClass('active');
}



var sortFunc = function (a, b) {
    if(a.time > b.time) return -1;
    if(a.time < b.time) return 1;
    if(a.name > b.name) return -1;
    if(a.name < b.name) return 1;
    return 0;
};


function create_nametag(name) {
    var pid = get_person_id(name);
    var i, k = 0,m=0;
    for (i = 0; i < person.length; i++) {
        k = person[i];
        m = person[i].name;

        //console.log("k");
        //console.log(k);
        var p_list, namecards = '';
        if(p_list==undefined){
            p_list = '';
        }


        p_list +=
            '<div id="">'+
            '<tr id="current-row-'+k['pid']+'" style="font-weight:bold; font-size:16px; font-family: Roboto;">' +
            '<td class="edit-participant"  ><em class="glyphicon glyphicon-pencil"  id="'+k['name']+'" onclick="edit_clicked(id);"></em></td>' +
            '<td class="delete-participant" ><em class="glyphicon glyphicon-trash" id="'+k['name']+'" onclick="delete_clicked(id);"></em></td>' +
            '<td id="update-participant-'+ k['name'] +'">' + k['name'] + '</td>' +
            '</tr>'+
            '</div>';

        namecards +=
            '<div class="draggable ui-draggable-handle" id="name-tag-'+pid+'">' +
            '<table id="person-tag" class="table table-responsive table-bordered name-tag" style="width:40px;overflow:hidden;">' +
			//'<table id="person-tag">' +
            '<tbody id="name-badge-'+k['name']+'" style="font-weight:bold; font-size:20px; font-family: Roboto;" disabled="disabled">'+
			
            '<tr id="name-card-'+k['name']+'">' +
            '<td rowspan="2" style="background-color:#cccccc; max-width:10px"><img style="padding:0; margin:0; border:0; width:10 px;" src="../../public_html/media/images/blank.gif" width="10 px"/></td>' +
            '<td class="person-tag" id="person-tag-'+ pid +'" style="text-align: center;" class="fixedsize"><div class="fixedsize">'+ k['name'] +'</div></td>' +
			'<td class="hand-tag" id="hand-tag-'+ pid +'"><i class="fa fa-hand-rock-o" aria-hidden="true" style="text-align: center;"></i></td>' +
            '</tr>' +
			
            '<tr id="handbull-icon-'+k['name']+'">' +
			//'<td class="timer" id="time-tag-'+ pid+'" style="text-align: center">' + k['timer_display'] + '</td>' +
			'<td class="timer" id="time-tag-'+ pid+'" style="text-align: center"><div class="fixedsize">' + k['timer_display'] + '</div></td>' +
			'<td class="oot-tag" id="oot-tag-'+ pid +'"><i class="fa fa-bullhorn" style="text-align: center;" aria-hidden="true"></i> </td>' +
            '</tr>' +
			
            '</tbody>'+
            '</table>' +
            '</div>';
    }

     document.getElementById('participant-list').innerHTML = p_list;

    $('#main-content').append(namecards);

    $('#name-tag-'+pid).draggable();

    $('#person-tag-'+pid).on('click', function() {
        name_click(k['name']);
    });

    $('#time-tag-'+pid).on('click', function() {
        timer_click(k['name']);
    });

    $('#oot-tag-'+pid).on('click', function() {
        oot_clicked(k['name']);
    });

    $('#hand-tag-'+pid).on('click', function() {
        hand_clicked(k['name']);
    });

    //$('#edit-participant-'+k['name']).on('click', function() {
    //
    //    edit_clicked(k['name']);
    //
    //});

    //$('#delete-participant-'+k['name']).on('click', function() {
    //    delete_clicked(k['name'])
    //});

}


var firstRun = true;

var format2DigitInt = function(i){
	return i>9 ? ""+i : "0"+i;
};

var formatTime = function(t){ //ben changed this 2017-12-7-6p
	var mins = Math.floor(t / 60);
	var hours = Math.floor(mins/60);
	mins -= hours*60;
	var secs = Math.floor(t % 60);
	return hours+":"+format2DigitInt(mins)+":"+format2DigitInt(secs);
};

$(document).ready(function() {
      if (firstRun) {
        firstRun = false;
        aString += "x";
        //console.log(aString);
        if (aString.length > 3) throw 'jquery bug is running ready more than4 once. astring=' + aString;
        $(".draggable").draggable();

        setInterval(function () { //1 timer for everyone
            var add_person_time = document.getElementById('add_person_time');
            for (x in person) {
                var pid = get_person_id(person[x].name);
                person[x].time += dt * person[x].spendRate;
                var t = person[x].time;
                if (person[x].time == 0 || person[x].spendRate != 0) { //update display of person's time
                    var id = 'time-tag-' + pid;
                    var timeString = formatTime(t);

                    document.getElementById(id).innerHTML = timeString;
                }
            }
            var tempPersons = [];
            var report ='';
            for(var i in person){
                tempPersons[i] = person[i];
            }
            tempPersons.sort(sortFunc);
            for(var i=0; i<tempPersons.length; i++){
                report += '<tr style="font-weight:bold; font-size:20px; font-family: Roboto;" id="display-report-'+tempPersons[i].pid+'">' +
                    '<td id="report-list-' + tempPersons[i].name + '"><div class="fixedsize">' + tempPersons[i].name + '</div></td>' +
                    '<td id="report-list-' + tempPersons[i].pid + '">'+formatTime(tempPersons[i].time)+'</td>' +
                    '</tr>';
                     document.getElementById('add_person_time').innerHTML = report;
            }

             setAllPersonsColors();


            // sortQueue();
            redrawQueue();
        }, Math.round(dt * 1000));



    }


});

//$(document).ready(function(){console.log('docready')});
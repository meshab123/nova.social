
var hand_down = 'glyphicon glyphicon-hand-down';
var hand_up =  'glyphicon glyphicon-hand-up';

$(document).ready(function(){

    $(document).on('click', '.person-tag', function() {
        alert("name");
    });

    $(document).on('click', '.time-tag', function() {

        alert("time");
    });

    $(document).on('click', '.speak-tag', function() {
        alert("speaker");
    });

    $(document).on('click', '.hand-tag', function() {
        alert("hand");
        var  name =$(this).closest('table').find(' tbody tr td:eq(0)').text();
        console.log(name);

         hand_click(name);
    });

    $('#participant-list tbody').on( 'click', 'button', function () {
            alert("ClickButton");
    });

    $( ".draggable" ).draggable();

});

function hand_click(name){
    var person_hand = '';
    var i, k = 0;
    for ( i = 0; i < person.length; i++) {
        k = person[i];
        if(k['name']==name){
           person_hand  = k['hand'];
        }
    }
    if(person_hand==0){
        //activate_hand();
        k['hand'] = 1;
        k['hand-_raised'] = k['time'];

       // $(".hand-tag").closest('table').find(' tbody tr td:eq(3)').removeClass('<em class = "glyphicon glyphicon-hand-down"></em>');
        $(".hand-tag").closest('table').find(' tbody tr td:eq(3)').html('<em class = "glyphicon glyphicon-hand-up"></em>');
        $(".hand-tag").closest('table').find(' tbody tr td:eq(3)').css('background-color','	lightgreen');

        push_to_queue(k['name'],k['timer_display'],k['hand_raised']);

    } else {

    }
}

function activate_hand() {
    k['hand'] = 1;
    $(this).css('background-color','green');
}

function deactivate_hand(pid) {
    person[pid].hand = 0;
}


function add_person(name){
    var p = {};
    for (var i=0, len=person.length; i<len; i++) {                      // iterate through all people
        if (person[i].name == name || name == '') {
            alert("Name already exists or is blank, try again");
            var new_name = prompt("Please enter name", "");
            add_person(new_name);
            return;
        }
    }
    //p.id = get_next_id();
    p.name = name;
    p.timer = null;                                                     // object to hold timer iterator
    p.time = 0;                                                         // time in seconds (integer)
    p.timer_display = "00:00";
    p.hand = 0;                                                         // 0 = Hand Not Raised; 1 = Hand Raised
    p.hand_raised = 0;                                                  // time when hand raised, to determine order if same time
    person.push(p);
    create_nametag(name);

    set_cookie();
    console.log(person);
}

function set_cookie() {
    $.cookie('person', JSON.stringify(person));
}

function delete_cookie() {
    $.cookie('person', null, { path: '/' });
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



function start_timer(n){
    timer[n]= setInterval(i);
}

function stop_all_timers(){
    // timer[k] = setInterval = 0;
}




function push_to_queue(name,time,hand_raised){

       queue.name = name;
       queue.time=time;
       queue['hand_raised'] = hand_raised;

    //sort queue by hand raised ascending
    queue.sort(function(a){
       return a.hand_raised;
    });
     var i,k = 0;
     for(i = 0; i < queue.length; i++){

         k = queue[i];
         var queue_list = '';
         queue_list +=
             '<tr>' +
             '<td>'+k['name']+'</td>' +
             '<td>'+k['time']+'</td>' +
             '</tr>';
         $("#add-queue-list").append(queue_list);

     }

    //add to DOM

}

function create_nametag(name) {
    //person.sort();
    //console.log("sorted array");
    //console.log(person);
    var i, k = 0;
    for (i = 0; i < person.length; i++) {
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
            '<div class="draggable ui-draggable-handle" id="'+k['name']+'">' +
            '<table id="person-tag"  class="table table-responsive table-bordered name-tag">' +
            '<tbody>'+
            '<tr>' +
            '<td class="person-tag">' + k['name'] + '</td>' +
            '<td class="time-tag">' + k['timer_display'] + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td class="speak-tag"></td>' +
            '<td class="hand-tag"><em class="glyphicon glyphicon-hand-down"></em></td>' +
            '</tr>' +
            '</tbody>'+
            '</table>' +
            '</div>';
    }
    document.getElementById('participant').innerHTML = p_list;
    $('#main-content').append(namecards);
    $('#'+k['name']).draggable();


}
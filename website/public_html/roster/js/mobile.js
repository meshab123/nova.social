/**
 * Created by shemeles.abebe on 11/22/2017.
 */

$(document).ready(function(){
   //redrawMobileQueue();
    createMobileQueue();
    mobileNameTag();
    handTag();

});

    var jsonParseParticipant = '';
    var jsonParseQueue = '';

    //function createCookie1(){
    //    var cookieValue = JSON.stringify(person,true);
    //    $.cookie( 'participants1' , cookieValue);
    //}


//SA:Reading participant name and updated time spent for each participant from the sotred cookie,
// and display updated report every time  when the user refresh the button.
    function createMobileReport(){
            var  decodeParticipant = decodeURIComponent(document.cookie);
               var currentCookie = '',
                    cookieValue,
                     cookieName = 'participants';
               var nameExpression = cookieName + "=";

            if(decodeParticipant.length>0){
                var participantData =decodeParticipant.split(';');
                var length = participantData.length;
                for(var i=0; i< length; i++){
                    currentCookie = participantData[i].trim();
                    if(currentCookie.indexOf(nameExpression)==0){
                        cookieValue = currentCookie.substring(nameExpression.length, currentCookie.length);
                    }
                    //alert(cookieValue);
                }

                var dataList = cookieValue.split(';');
                 jsonParseParticipant = JSON.parse(dataList);


                var arrayLength = jsonParseParticipant.length;
                var report = '';
                sortReport();
                for(var i =0; i<arrayLength; i++){
                    var t = jsonParseParticipant[i].time;
                    var timeString = Math.floor(t/60)+":"+Math.floor(t%60);
                    report += '<tr style="font-weight:bold; font-size:20px; font-family: Roboto;">' +
                        '<td id="report-list-' + jsonParseParticipant[i].name + '">' + jsonParseParticipant[i].name + '</td>' +
                        '<td id="report-list-' + jsonParseParticipant[i].time + '">' + timeString + '</td>' +
                        '</tr>';
                    document.getElementById('mobile_report').innerHTML = report;
                }
            }
        }

    function sortReport(){

        jsonParseParticipant.sort(function (a, b) {
            if(a.time > b.time) return -1;
            if(a.time < b.time) return 1;
            return 0;
        });
        // }
    }


    //SA: Read stored queue cookie data and display the list on page load
    function createMobileQueue(){
        var  decodequeue = decodeURIComponent(document.cookie);

        var currentCookie = '',
            cookieValue,
            cookieName = 'queue';
        var nameExpression = cookieName + "=";

        if(decodequeue.length>0){
            var queueData =decodequeue.split(';');
            alert(decodequeue);
            var length = queueData.length;
            for(var i=0; i< length; i++){
                currentCookie = queueData[i].trim();
                if(currentCookie.indexOf(nameExpression)==0){
                    cookieValue = currentCookie.substring(nameExpression.length, currentCookie.length);
                }
            }

            var dataList = cookieValue.split(';');
            jsonParseQueue  = JSON.parse(dataList);
           // alert(jsonParseQueue);

            var arrayLength = jsonParseQueue.length;
            //sortReport();
            for(var i =0; i<arrayLength; i++){
                var html = '';
                for(var i=0; i < arrayLength;i++){
                    html += '<tr><td id="mobile-queue-list-' + jsonParseQueue[i].name + '" style="font-weight:bold; font-size:20px;">' + jsonParseQueue[i].name + '</td></tr>';
                }
                document.getElementById('add-mobile-queue-list').innerHTML = html;
            }
        }
    }



    function mobileNameTag(){
        var nameCards = '';

        nameCards +=
            '<div class="draggable ui-draggable-handle" id="" style="margin-left: 20px; margin-top: 50px;">' +
                '<table id="" class="table table-responsive table-bordered name-tag">' +
                '<tbody id="" style="font-weight:bold; font-size:20px; font-family: Roboto;" disabled="disabled">'+
                '<tr>' +
                '<td class="name" id="name-card" style="text-align: center;">Mesh</td>' +
                '</tr>' +
                '<tr>' +
                '<td class="timer" id="" style="text-align: center;">2:22</td>' +
                '</tr>' +
                '</tbody>' +
                '</table>'+
                '</div>'+
                '<br/>';

             document.getElementById('name-tag').innerHTML = nameCards;


}

function handTag(){
    var handTag = '';

    handTag +=
        '<div class="draggable ui-draggable-handle" id="" style="margin-left: 30px; margin-top:-150px;">' +
        '<table id="" class="">' +
        '<tbody id="" style="font-weight:bold; font-size:20px; font-family: Roboto;">'+
        '<tr>' +
        '<td class="" id="hand-tag"><i class="fa fa-hand-rock-o" aria-hidden="true"style="margin-left: 40px; font-size:larger;" ;"></i></td>' +
        '</tr>' +
        '</tbody>' +
        '</table>'+
        '</div>';
        document.getElementById('hand-tag').innerHTML = handTag;


}









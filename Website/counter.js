//Create val variable to store button value
let val;

//Create counterHandling function to handle queue
function callNext(no) {
    $.post(
        "counter_handling.php",
        {
            callNext: no,
        },
        function (data) {
            //If there is ticket waiting in the queue
            if (data > 0) {
                alert(data);
            } else {
                alert(data);
            }
        }
    );
}

//Create complteCurrent function to change the queue status to complete
function completeCurrent(no) {
    $.post(
        "counter_handling.php",
        {
            compCurr: no,
        },
        function (data) {
            //If there is ticket waiting in the queue
            if (data > 0) {
                alert(data);
            } else {
                alert(data);
            }
        }
    );
}

//Create goOfflineOnline function to change the counter status to offline/online
function goOfflineOnline(no) {
    $.post(
        "counter_handling.php",
        {
            goOffOn: no,
        },
        function (data) {
            //If there is ticket waiting in the queue
            console.log(data);
            if (data == "Online") {
                alert("Counter " + no + " is online");
                $("#go_off_on" + no).html("Go offline");
            } else {
                alert("Counter " + no + " is offline");
                $("#go_off_on" + no).html("Go online");
            }
        }
    );
}

$(document).ready(function () {
    //Retrieve counter status to determine button name
    $.get("counter_handling.php", function (data) {
        let counterStatus = JSON.parse(data);
        console.log(counterStatus);
        counterStatus.forEach((item) => {
            if (item.counterStatus == "Offline") {
                $("#go_off_on" + (item.counterNo)).html("Go online");
            } else {
                $("#go_off_on" + (item.counterNo)).html("Go offine");
            }
        });
    });
});

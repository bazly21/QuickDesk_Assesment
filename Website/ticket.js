function counterStatusText(counter, status, ticketno, serveCounter) {
  //If status is Online or Available
  if (status == "Online") {
    $("#c" + counter).html("");
  } else if (status == "Offline") {
    $("#c" + counter).html("Offline");
  } else {
      $("#c" + counter).html(ticketno);
  }
}

function addClassListCircle(index, status1, status2, status3) {
  let circle = document.getElementById("circle" + index);

  circle.classList.add("circle-" + status1);
  circle.classList.remove("circle-" + status2);
  circle.classList.remove("circle-" + status3);
}

function addClassListLabel(index, status1, status2) {
  let label = document.getElementById("label" + index);

  label.classList.add("label-" + status1);
  label.classList.remove("label-" + status2);
}

$(document).ready(function () {
  $("button").click(() => {
    document.createElement;
    $.get("get_ticket.php", function (data) {
      //Get ticketNo and counter from data by using slice method
      let ticketNo = data.slice(0, data.indexOf(","));
      let counter = data.slice(data.indexOf(",") + 1);

      $("#lastNo").html(ticketNo);
      alert("Your ticket number is: " + ticketNo + " at counter " + counter);
    });
  });

  function updateData() {
    //Use AJAX to call the PHP script and fetch the data
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "update_data.php", true);
    xhr.onreadystatechange = () =>{
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // If the PHP script returns data, display it on the HTML page
        let receive = xhr.responseText;
        console.log(receive);

        let ticketNo_Queue = receive.slice(0, receive.indexOf("."));
        let counterNo_Status = receive.slice(receive.indexOf(".")+1);
        

        if(counterNo_Status != "0"){
          counterNo_Status = JSON.parse(counterNo_Status);

          counterNo_Status.forEach(item => {
            if (item.counterStatus == "Online") {
              counterStatusText(item.counterNo, "Online");
              addClassListCircle(item.counterNo, "online", "offline", "busy");
              addClassListLabel(item.counterNo, "online", "offline");
            } else if (item.counterStatus == "Offline") {
              counterStatusText(item.counterNo, "Offline");
              addClassListCircle(item.counterNo, "ofline", "online", "busy");
              addClassListLabel(item.counterNo, "ofline", "online");
            } else {
              addClassListCircle(item.counterNo, "busy", "offline", "online");
              addClassListLabel(item.counterNo, "online", "offline");
            }
          });
        }

        if (ticketNo_Queue != "0") {
          ticketNo_Queue = JSON.parse(ticketNo_Queue);
          console.log(ticketNo_Queue);

          ticketNo_Queue.forEach((item, index) => {
            if (index == 0) {
              $("#nowServe").html(item.ticketNo);
              counterStatusText(item.counterNo, "busy", item.ticketNo);
            }else{
              counterStatusText(item.counterNo, "busy", item.ticketNo);
            }
          });
        }
      }
    };
    xhr.send();
  }

  //Call the fetchData function every 2 seconds to refresh the data
  setInterval(updateData, 2000);
});

<?php

include "connection.php";

if (isset($_POST['callNext'])) {
    $counterNo = $_POST['callNext'];
    $query = "SELECT t.ticketNo, t.counterNo, c.counterStatus 
                  FROM customer t JOIN counter c 
                  ON (t.counterNo = c.counterNo)
                  WHERE t.status = 'Waiting' AND t.counterNo = " . $counterNo . " ORDER BY ticketNo LIMIT 1";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_row();

        //If counter status is available
        if ($row[2] === "Online") {
            //Update the selected row status to 'Serve'
            $updateQuery = " UPDATE customer SET status = 'Serve', serveTime = CURRENT_TIME() WHERE ticketNo =" . $row[0];

            //If update is successful 
            if ($conn->query($updateQuery)) {

                //Update the selected counter counterStatus to busy
                $updateQuery = "UPDATE counter SET counterStatus = 'Busy' WHERE counterNo =" . $row[1];

                //If update is successful 
                if ($conn->query($updateQuery)) {
                    //Return 'Now serving: counterNo'
                    echo "Now serving: " . $row[0];
                }
            } else {
                echo "Error updating record";
            }
        } else {
            echo "Unable to call next ticket number. Please complete the current ticket first";
        }
    } else {
        echo "No tickets in the waiting queue";
    }
}

//If complete current button is clicked
else if (isset($_POST["compCurr"])) {
    $counterNo = $_POST["compCurr"];

    $query = "SELECT ticketNo, counterNo FROM customer WHERE status = 'Serve' AND counterNo = " . $counterNo . " ORDER BY ticketNo LIMIT 1";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_row();

        //Update ticket status to 'Complete'
        $updateQuery = "UPDATE customer SET status = 'Complete' WHERE ticketNo = " . $row[0];

        //If ticket's status update is successful
        if ($conn->query($updateQuery)) {
            $updateQuery = "UPDATE counter SET counterStatus = 'Online' WHERE counterNo =" . $row[1];

            //If counter's status update is successful
            if ($conn->query($updateQuery)) {
                echo "Ticket number " . $row[0] . " has been completed. Counter " . $row[1] . " is now available";
            }
        }
    } else {
        echo "There is no ticket currently being serve";
    }
}
//If go offline/go online button is clicked
else if (isset($_POST["goOffOn"])) {

    $counterNo = $_POST["goOffOn"];

    //Fetch data to know the counter's status
    $query = "SELECT counterStatus FROM counter WHERE counterNo = " . $counterNo;

    $result = $conn->query($query);

    if ($result->num_rows > 0) {

        //Store counter's status inside row variable
        $row = $result->fetch_row();

        //If counter's status other than offline (Online)
        if ($row[0] != 'Offline') {
            $updateQuery = "UPDATE counter SET counterStatus = 'Offline' WHERE counterNo = " . $counterNo;

            //If counter's status successfully change to offline
            if ($conn->query($updateQuery)) {

                //Change ticket's status other than 'Complete' to 'Pending'
                $query = "SELECT ticketNo FROM customer WHERE status <> 'Complete' AND counterNo = " . $counterNo;

                $result = $conn->query($query);

                //If there are any ticket's status other than 'Complete'
                if ($result->num_rows > 0) {
                    //Fetch all row and store it into $data
                    while ($row = $result->fetch_row()) {
                        $data[] = $row[0];
                    }

                    //Convert array to string format
                    $strData = implode(", ", $data);

                    $updateQuery = "UPDATE customer SET status = 'Waiting' WHERE ticketNo IN (" . $strData . ")";

                    //If update is not successful
                    if (!$conn->query($updateQuery)) {
                        echo "Hey 1";
                    }
                }
                echo "Offline";
            } else {
                echo 0;
            }
        } 
        //If counter's status is offline
        else {
            $updateQuery = "UPDATE counter SET counterStatus = 'Online' WHERE counterNo = " . $counterNo;

            //If counter's status successfully change to offline
            if ($conn->query($updateQuery)) {
                echo "Online";
            } else {
                echo "Counter is not exist";
            }
        }
    }
}else{
    $query = "SELECT * FROM counter";

        $result = $conn->query($query);

        if($result -> num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }

            echo json_encode($data);
        }
}

$conn->close();

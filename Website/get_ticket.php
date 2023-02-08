<?php

    include "connection.php";

    // // SQL query to fetch data from the database table
    $randNo = rand(1,4);
    $status = "Waiting";

    $insertQuery = $conn->prepare("INSERT INTO customer (status, counterNo) VALUES (?, ?)");
    
    $insertQuery->bind_param("si", $status, $randNo);
    //$insertQuery->execute();

    //If insertion is successful
    if($insertQuery->execute() === TRUE){

        $query = "SELECT ticketNo FROM customer ORDER BY ticketNo DESC LIMIT 1";
        $result = $conn->query($query);

        // Check if the query returns any data
        if ($result->num_rows > 0) {
            // Loop through the data and store it in an array
            $row = $result->fetch_row();
            // $data[] = $row;
            // $data = json_encode($data);
            // while($row = $result->fetch_assoc()) {
            //     $data[] = $row;
            // }
            // // Convert the array to JSON format
            // $data = json_encode($data);
            
            // // Return the JSON data
            echo $row[0].", ".$randNo;
        } else {
            echo "There is no ticket";
        }
    }
    else{
        echo "Error! Ticket number could not be obtained";
    }
    

    $conn->close();

?>
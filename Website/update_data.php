<?php

    include "connection.php";

    // // SQL query to fetch data from the database table
    $refreshQuery = "SELECT ticketNo, counterNo FROM customer WHERE status='Serve' ORDER BY serveTime DESC LIMIT 4";
    $counterQuery = "SELECT * FROM counter";

    $result = $conn->query($refreshQuery);
    

    // Check if the query returns any data
    if ($result->num_rows > 0) {

        //Store ticket data to $row
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        //Convert the data into JSON format
        $data = json_encode($data);

        echo $data.".";
    }else{
        echo 0 .".";
    }

    $result = $conn->query($counterQuery);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $data1[] = $row;
        }

        $convertData = json_encode($data1);

        echo $convertData;
    }
        // $data1 = [];
        // // Loop through the data and store it in an array
        // while($row = $result->fetch_assoc()){
        //     $data1[] = $row;
        // }

        // //Convert the data into JSON format
        // $convertData = json_encode($data1);

        // // Return the JSON data
        // echo $convertData;

        // // Return the JSON data
        // echo $data;
        
    else {
        echo 0;
    }

    // $result = $conn->query($refreshQuery);

    // // Check if the query returns any data
    // if ($result->num_rows > 0) {
    //     // Loop through the data and store it in an array
    //     //$row = $result->fetch_assoc();

    //     //Convert the data into JSON format
    //     $data = json_encode($row);

    //     // // Return the JSON data
    //     echo $data;
    // } else {
    //     echo 0;
    // }

$conn->close();

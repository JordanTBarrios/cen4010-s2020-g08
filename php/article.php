<?php
    //establish connection to database
    $database = mysqli_connect("localhost", "cen4010s2020_g08", "faueng2020", "cen4010s2020_g08");

    session_start();

    //default articles diplayed (up to 3)
    $sql = "SELECT * FROM articles WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($database, $sql);
    $row = mysqli_fetch_array($result,  MYSQLI_ASSOC);
    
    //if user searches of other articles
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["articleDataButton"]){
            
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, 'https://gnews.io/api/v3/{endpoint}?token=API-Token'); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
            $data = curl_exec($ch); 
            curl_close($ch);
            
            echo $data.articleCount;
            
        }
    }

?>
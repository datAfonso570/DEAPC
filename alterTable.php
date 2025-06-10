<?php
   /*session_start();
    if(!isset($_SESSION['logedin'])){
        header('Location:http://localhost/deapc/index.html');
        session_destroy();
    }*/
    

    libxml_use_internal_errors(true); 
    $servername= "localhost";
    $username = "ap";
    $password = "741a963";
    $dbname = "deapc";  
   
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $db = new mysqli($servername, $username, $password, $dbname);
        if($db->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        $query = "UPDATE orders_client SET stat=' ". $_POST["status"] . "' WHERE orderID = ?";
        $query2="SELECT * FROM orders_client WHERE orderID = ?";
        
        
        $stmt=$db->stmt_init();
        $stmt->prepare($query);
        $stmt->bind_param("s",$cond);        

        $cond = $_POST["condition"];
        
        if($stmt->execute()){
            $stmt->prepare($query2);
            $stmt->bind_param("s",$cond);
            
            $stmt->execute();
            $results = $stmt->get_result();
            $out=$results->fetch_all(MYSQLI_ASSOC);           
            echo json_encode($out);  
        }else{
            $out["noResult"]=true;
            echo json_encode($out);  
        }
               

    } 

    
    ?> 
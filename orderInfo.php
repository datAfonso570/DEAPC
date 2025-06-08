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
        $sql1="select * from orders_products where orderID = \"" . $_POST["searchID"]."\"";
        $sql2="select * from orders_client where orderID = \"" . $_POST["searchID"]."\"";
        

        $url="localhost/deapc/".$_POST["page"];
                        
        $htmlDoc = new DOMDocument();
        $htmlDoc->loadHTMLFile($_POST["page"]);
                   
        $results = $db->query($sql2);
        if($results->num_rows>0){
            while($row=$results->fetch_assoc()){
                $tr=$htmlDoc->createElement("tr","");
                $tr->setAttribute("class","label-font");
                foreach($row as $v){
                    $td=$htmlDoc->createElement("td",$v); 
                    $td->setAttribute("class","label-font");                   
                    $tr->appendChild($td);                    
                }
                $htmlDoc->getElementById("infoTable")->appendChild($tr);
                
            }
            $htmlDoc->getElementById("infoDiv")->setAttribute("style","display:block");
            
            echo $htmlDoc->saveHTML();
        }else{
            echo $htmlDoc->saveHTML();
        }

        

    } 

    
    ?> 
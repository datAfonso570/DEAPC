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
                $tr->setAttribute("class","label-font2");
                foreach($row as $v){
                    $td=$htmlDoc->createElement("td",$v); 
                    $td->setAttribute("class","label-font2");                   
                    $tr->appendChild($td);                    
                }
                $td->setAttribute("id","status");
                $htmlDoc->getElementById("infoTable")->appendChild($tr);
                
            }
            $htmlDoc->getElementById("infoDiv")->setAttribute("style","display:block");
            
            //echo $htmlDoc->saveHTML();
        }else{
            echo $htmlDoc->saveHTML();
        }
        $status = trim($td->nodeValue);
        
        $checkbox=$htmlDoc->createElement("input","");
        
        $results = $db->query($sql1);
        if($results->num_rows>0){
            while($row=$results->fetch_assoc()){
                $tr=$htmlDoc->createElement("tr","");
                $tr->setAttribute("class","label-font2");                
                foreach($row as $v){
                    if($v != $_POST["searchID"]){
                        $td=$htmlDoc->createElement("td",$v); 
                        $td->setAttribute("class","label-font2");                   
                        $tr->appendChild($td);     
                    }
                                     
                }
                $td=$htmlDoc->createElement("td","");
                $checkbox=$htmlDoc->createElement("input","");
                $checkbox->setAttribute("type","checkbox");
                $checkbox->setAttribute("name","pRow");
                if(strcmp($status, "CANCELLED")==0){
                    $checkbox->setAttribute("disabled","");//for boolean attributes you can't use true or false, the moment you create the attribute, it's read as true.
                    //so if you want the attribute to have a true value, simply create it, if you want a false value don't create the attribute
                    //$checked = $htmlDoc->createAttribute("checked");
                    //$checkbox->appendChild($checked);
                }elseif(strcmp($status, "SENT")==0){
                    $checkbox->setAttribute("disabled","");                  
                    
                    $checkbox->setAttribute("checked","");
                     
                }                    
                $td->appendChild($checkbox); 
                $tr->appendChild($td);
                $htmlDoc->getElementById("orderTable")->appendChild($tr);
                
            }
            $td=$htmlDoc->createElement("td","");
            $tr=$htmlDoc->createElement("tr","");
            $hid=$htmlDoc->createElement("input","");
            $hid->setAttribute("type","hidden");
            $hid->setAttribute("id","orderID"); 
             $hid->setAttribute("value",$_POST["searchID"]); 
            $td->appendChild( $hid); 
            $htmlDoc->getElementById("buttonsTable")->appendChild($td);
            $htmlDoc->getElementById("tableDiv")->setAttribute("style","display:block");
            
            echo $htmlDoc->saveHTML();
        }else{
            echo $htmlDoc->saveHTML();
        }
        

    } 

    
    ?> 
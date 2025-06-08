
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
        $table = $_POST["table"];

        if($table == "clients"){
            $query="SELECT * FROM " . $table." WHERE nif = ?";
        }elseif($table=="products"){
            $query="SELECT * FROM " . $table." WHERE id = ?";
        }
        
        $stmt=$db->stmt_init();
        $stmt->prepare($query);
        $stmt->bind_param("s",$cond);
        

        $cond = $_POST["condition"];
        $stmt->execute();
        $results = $stmt->get_result();
        $out=$results->fetch_all(MYSQLI_ASSOC);
        $out[0]["table"]=$table;
        echo json_encode($out);
        //$result= $db->query("SELECT * FROM products WHERE id=1");
        //var_export($result->fetch_assoc());

    }else{
        $url="localhost/deapc/".$_POST["url"];
         //include($_POST["url"]);
        $htmlDoc = new DOMDocument();
        $htmlDoc->loadHTMLFile($_POST["url"]);
        echo $htmlDoc->saveHTML();
        /*$id='orderID';
        $htmlDoc->getElementbyID($id)->nodeValue="changed2 again";
        echo $htmlDoc->saveHTML();*/
    }
    



    /*$s = [];
    $s['id']='asdasd';
    $s['id3']=['asdasd5','werwer','werwr'];  
    $s['id5']='asdasd6';      
    $j=json_encode($s);
    echo $j;*/
    ?> 


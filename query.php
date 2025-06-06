
   <?php
   /*session_start();
    if(!isset($_SESSION['logedin'])){
        header('Location:http://localhost/deapc/index.html');
        session_destroy();
    }*/
   //$url="localhost/deapc/".$_POST["url"];
   //include($_POST["url"]);
    libxml_use_internal_errors(true);
   /*$htmlDoc = new DOMDocument();
    $htmlDoc->loadHTMLFile($_POST["url"]);
    //echo $htmlDoc->saveHTML();
    $id='orderID';
    $htmlDoc->getElementbyID($id)->nodeValue="changed2 again";
    echo $htmlDoc->saveHTML();*/
    $s = [];
    $s['id']='asdasd';
    $s['id3']=['asdasd5','werwer','werwr'];  
    $s['id5']='asdasd6';      
    $j=json_encode($s);
    echo $j;
    ?> 


<html>
<body>
   <?php
   $url="localhost/deapc/".$_POST["url"];
   //include($_POST["url"]);
    libxml_use_internal_errors(true);
    $htmlDoc = new DOMDocument();
    $htmlDoc->loadHTMLFile($_POST["url"]);
    //echo $htmlDoc->saveHTML();
    $id='orderID';
    $htmlDoc->getElementbyID($id)->nodeValue="changed2 again";
    echo $htmlDoc->saveHTML();

    ?> 
</body>

</html>

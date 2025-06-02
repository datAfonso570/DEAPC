<html>    
<?php
    $htmlDoc = new DOMDocument();
    $htmlDoc->loadHTML("uti3.html");

    $x = $htmlDoc->documentElement;
    foreach ($x->childNodes AS $item) {
    print $item->nodeName . " = " . $item->nodeValue . "<br>";
    }
?>
</html>
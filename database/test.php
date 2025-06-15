<html>
    <head>
        
        <title> Testing db</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body class="general-body">
        <table border ="1">
                <caption>Client Information</caption>
                <tr><th>NAME</th><th>ADDRESS</th></tr>
                    <?php 
                        $servername= "localhost";
                        $username = "ap";
                        $password = "741a963";
                        $dbname = "deapc_db";

                        $db = new mysqli($servername, $username, $password, $dbname);
                        if($db->connect_error){
                            die("Connection failed: " . $conn->connect_error);
                        }
                        
                        $sql="select * from clients";
                        $result = $db->query($sql);

                        if($result->num_rows>0){
                            
                            while($row = $result->fetch_assoc()){
                                echo "<tr><td>".$row["name"]."</td><td>".$row["address"]."</td></tr>\n";
                            }
                        
                        }
                        $url="localhost/deapc/".$_POST["url"];
                        //include($_POST["url"]);
                        $htmlDoc = new DOMDocument();
                        $htmlDoc->loadHTMLFile($_POST["url"]);
                        echo $htmlDoc->saveHTML();
                        /*$id='orderID';
                        $htmlDoc->getElementbyID($id)->nodeValue="changed2 again";
                        echo $htmlDoc->saveHTML();*/
                        //$result= $db->query("SELECT * FROM products WHERE id=1");
        //var_export($result->fetch_assoc());
                    ?>
        </table>
    </body>
</html>


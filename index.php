<html>
    <head>
        <title>Connecting Web to MariaDB Server</title>
    </head>

    <body>
    <?php

    $ip_server = $_SERVER['SERVER_ADDR'];
    echo "Server IP Address is: $ip_server";
    $dbname = "192.168.254.161";
    $username = "admin";
    $password = "password";
    echo "<br>";

    try {
        $conn = new PDO("mysql:host=$dbname;dbname=Fiifi_db" , $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully to mysql database at IP address $dbname";
    }  catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>
    </body>
</html>
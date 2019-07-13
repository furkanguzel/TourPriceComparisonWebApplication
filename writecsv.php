<?php
header('Content-Type: text/html; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csv";
//For create connection buda bir sorun var ayrı ayrı çalıştırınca sorun olmadı ama.DATABASE İ silip yaz
$conn = new mysqli($servername, $username, $password, $dbname);
$conn1 = new mysqli($servername, $username, $password, $dbname);
$conn2 = new mysqli($servername, $username, $password, $dbname);


$querydel = "Delete from hotels";
$querydel1 = "Delete from flights";
$querydel2 = "Delete from tours";


$query = "LOAD DATA LOCAL INFILE 
                'C:/Users/Furkan Guzel/PycharmProjects/WebScraping/HotelsInfo.csv'
                INTO TABLE hotels
                CHARACTER SET 'UTF8'
                FIELDS TERMINATED BY ';'
                LINES TERMINATED BY '\r\n';";

$query1 = "LOAD DATA LOCAL INFILE 
                'C:/Users/Furkan Guzel/PycharmProjects/WebScraping/FlightsInfo.csv'
                INTO TABLE flights
                CHARACTER SET 'UTF8'
                FIELDS TERMINATED BY ';'
                LINES TERMINATED BY '\r\n';";

$query2 = "LOAD DATA LOCAL INFILE 
                'C:/Users/Furkan Guzel/PycharmProjects/WebScraping/ToursInfo.csv'
                INTO TABLE tours
                CHARACTER SET 'UTF8'
                FIELDS TERMINATED BY ';'
                LINES TERMINATED BY '\r\n';";

mysqli_query($conn, $querydel);
mysqli_query($conn1, $querydel1);
mysqli_query($conn2, $querydel2);


if (!$result = mysqli_query($conn, $query)){
    echo '<script>alert("Oops... Some Error occured111utf8mistake.");</script>';
    exit();
    //exit(mysqli_error());
}
elseif (!$result = mysqli_query($conn, $query1)){
    echo '<script>alert("Oops... Some Error occured222utf8mistake.");</script>';
    exit();
    //exit(mysqli_error());
}
elseif (!$result = mysqli_query($conn, $query2)){
    echo '<script>alert("Oops... Some Error occured3333utf8mistake.");</script>';
    exit();
    //exit(mysqli_error());
}

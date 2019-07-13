<?php
#session_start();

$hostname = "localhost";
$dbname = "csv";
$Username = "root";
$Password = "";

$conn = mysqli_connect($hostname, $Username, $Password, $dbname);
mysqli_query($conn,"SET NAMES UTF8");

if (!$conn) {
    die("Connection Failed:" . mysqli_connect_error());
}
if (isset($_POST['decrease'])) {
    $txtStartDate1 = $_POST['inDate'];
    $txtEndDate1 = $_POST['outDate'];
    $wherefrom = $_POST['submit2'];
    $whereto = $_POST['submit3'];
    $sql = mysqli_query($conn, "SELECT *,flight_img,flight_name,depLand_time1,city1,airport1,depLandtime2,city2,airport2,LEFT(price,length(price)-3) as number1 FROM flights
                                          Where  city1='$wherefrom' and city2='$whereto' and indate>='$txtStartDate1' and outdate<='$txtEndDate1' ORDER BY number1 * 1 DESC");

    while ($row = mysqli_fetch_array($sql)) {
        $result = $row['flight_img'];
        $result1 = $row['flight_name'];
        $result2 = $row['depLand_time1'];
        $result3 = $row['city1'];
        $result4 = $row['airport1'];
        $result5 = $row['depLandtime2'];
        $result6 = $row['city2'];
        $result7 = $row['airport2'];
        $result8 = $row['number1'];
        $result9 = $row['link_adress'];
        $flight = $row['flight_id'];
        $a = str_replace('"', '', $result9);

        $space = "   ";
        echo "<h1><img src=" . $result . "  width=\"150\" height=\"150\"/> <h2>$result1 &nbsp; $result2 &nbsp; $result3 &nbsp; $result4 &nbsp; $result5 &nbsp; $result6 &nbsp; $result7 &nbsp; $result8 </h2>
        <a href='?added=$flight'>[Add to Basket]</a><a href='$a'>[Go to website]</a><br>";
    }

} else if (isset($_POST['increase'])) {
    $txtStartDate = $_POST['inDate'];
    $txtEndDate = $_POST['outDate'];
    $wherefrom = $_POST['submit2'];
    $whereto = $_POST['submit3'];
    $query1 = mysqli_query($conn, "Select * from flights Where  city1='$wherefrom' and city2='$whereto' and indate>='$txtStartDate' and outdate<='$txtEndDate'");
    $count = mysqli_num_rows($query1);

    if ($count == "0") {
        echo '<h2>There are no hotels between these dates!</h2>';
    } else {
        $count = 0;
        while ($row = mysqli_fetch_array($query1)) {
            $result = $row['flight_img'];
            $result1 = $row['flight_name'];
            $result2 = $row['depLand_time1'];
            $result3 = $row['city1'];
            $result4 = $row['airport1'];
            $result5 = $row['depLandtime2'];
            $result6 = $row['city2'];
            $result7 = $row['airport2'];
            $result8 = $row['price'];
            $result9 = $row['link_adress'];
            $flight = $row['flight_id'];
            $a = str_replace('"', '', $result9);

            $space = "   ";
            echo "<h1 ><img src=" . $result . "  width=\"150\" height=\"150\"/> <h2>$result1 &nbsp; $result2 &nbsp; $result3 &nbsp; $result4 &nbsp; $result5 &nbsp; $result6 &nbsp; $result7 &nbsp; $result8 </h2>
            <a href='?added=$flight'>[Add to Basket]</a><a href='$a'>[Go to website]</a><br>";
            $count++;

        }
    }

}

?>
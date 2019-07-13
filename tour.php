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
if (isset($_POST['increase1'])) {

    $txtStartDate = $_POST['txtStartDate'];
    $txtEndDate = $_POST['txtEndDate'];
    $tourLocation = $_POST['submit4'];

    $sql = mysqli_query($conn, "SELECT * ,LEFT(price,length(price)-3) as number FROM tours 
                                                  Where tour_location='$tourLocation' and CheckIn>='$txtStartDate' and CheckOut<='$txtEndDate' ORDER BY number * 1 ");

    while ($row = mysqli_fetch_array($sql)) {
        $result = $row['tour_img'];
        $result1 = $row['tour_name'];
        $result2 = $row['number'];
        $result3 = $row['tour_id'];
        $result4 = $row['link_adress'];
        $a = str_replace('"', '', $result4);

        #$result3 = $row['number']; gerekirse ulasım ek kısmını ekleriz

        echo "<h1 ><img src=" . $result . "  width=\"150\" height=\"150\"/> <h2>$result1 &nbsp; $result2 TL </h2><a href='?added1=$result3'>[Add to Basket]</a><a href='$a'>[Go to website]</a><br>";
    }

} else if (isset($_POST['decrease1'])) {
    $txtStartDate = $_POST['txtStartDate'];
    $txtEndDate = $_POST['txtEndDate'];
    $tourLocation = $_POST['submit4'];

    $sql = mysqli_query($conn, "SELECT *,LEFT(price,length(price)-3) as number FROM tours 
                                              Where tour_location='$tourLocation' and CheckIn>='$txtStartDate' and CheckOut<='$txtEndDate' ORDER BY number * 1 DESC");

    while ($row = mysqli_fetch_array($sql)) {
        $result = $row['tour_img'];
        $result1 = $row['tour_name'];
        $result2 = $row['number'];
        $result3 = $row['tour_id'];
        $result4 = $row['link_adress'];
        $a = str_replace('"', '', $result4);

        #$result3 = $row['number']; gerekirse ulasım ek kısmını ekleriz

        $space = "   ";
        echo "<h1 ><img src=" . $result . "  width=\"150\" height=\"150\"/> <h2>$result1 &nbsp; $result2 TL </h2><a href='?added1=$result3'>[Add to Basket]</a><a href='$a'>[Go to website]</a><br>";
    }

} else if (isset($_POST['search2'])) {
    try {
        $txtStartDate = $_POST['txtStartDate'];
        $txtEndDate = $_POST['txtEndDate'];
        $tourLocation = $_POST['submit4'];
        $query2 = mysqli_query($conn, "SELECT * from tours Where tour_location='$tourLocation' and CheckIn>='$txtStartDate' and CheckOut<='$txtEndDate'");
        $count = mysqli_num_rows($query2);
    } catch (Exception $e) {
        echo 'Yakalanan olağandışılık: ',  $e->getMessage(), "\n";
    }

    if ($count == "0") {
        echo '<h2>There are no hotels between these dates!</h2>';
    } else {
        $count = 0;
        while ($row = mysqli_fetch_array($query2)) {
            $result = $row['tour_img'];
            $result1 = $row['tour_name'];
            $result2 = $row['price'];
            $result3 = $row['tour_id'];
            $result4 = $row['link_adress'];
            $a = str_replace('"', '', $result4);

            #$rest = substr($result2,0, -3);
            #$num = (float)$rest;
            #$array[] = $num;
            #sort($array);
            #sadeceparayı sortladık diğerlerini unutma
            echo "<h1 ><img src=" . $result . "  width=\"150\" height=\"150\"/> <h2>$result1 &nbsp; $result2  </h2><a href='?added1=$result3'>[Add to Basket]</a><a href='$a'>[Go to website]</a><br>";

            $count++;

        }
    }

}

?>
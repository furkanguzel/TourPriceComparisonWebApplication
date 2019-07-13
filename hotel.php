<?php
#session_start();
#header('content-type: text/html; charset=utf8');
#ob_start();
$hostname = "localhost";
$dbname = "csv";
$Username = "root";
$Password = "";

$conn = mysqli_connect($hostname, $Username, $Password, $dbname);
mysqli_query($conn,"SET NAMES UTF8");

if (!$conn) {
    die("Connection Failed:" . mysqli_connect_error());
}
if (isset($_POST['inc'])) {
    $txtStartDate = $_POST['txtStartDate'];
    $txtEndDate = $_POST['txtEndDate'];
    $location = $_POST['submit1'];
    $sql = mysqli_query($conn, "SELECT *,hotel_id,hotel_img,hotel_name ,LEFT(hotel_price,length(hotel_price)-3) as number FROM hotels 
                                                  Where hotel_location='$location' and CheckInDate>='$txtStartDate' and CheckOutDate<='$txtEndDate' ORDER BY number * 1 ");

    while ($row = mysqli_fetch_array($sql)) {
        $result = $row['hotel_img'];
        $result1 = $row['hotel_name'];
        $result2 = $row['number'];
        $result3 = $row['link_adress'];
        $hotel = $row['hotel_id'];
        $a = str_replace('"', '', $result3);


        echo "<h1 ><img src=" . $result . "  width=\"150\" height=\"150\"/> <h2>$result1 &nbsp; $result2 TL </h2><a href='?ekle=$hotel'>[Add to Basket]</a><a href='$a'>[Go to website]</a><br>";
    }
}

else if (isset($_POST['dec'])) {
    $txtStartDate = $_POST['txtStartDate'];
    $txtEndDate = $_POST['txtEndDate'];
    $location = $_POST['submit1'];

    $sql = mysqli_query($conn, "SELECT * ,LEFT(hotel_price,length(hotel_price)-3) as number FROM hotels 
                                              Where  hotel_location='$location' and CheckInDate>='$txtStartDate' and CheckOutDate<='$txtEndDate' ORDER BY number * 1 DESC");

    while ($row = mysqli_fetch_array($sql)) {
        $result = $row['hotel_img'];
        $result1 = $row['hotel_name'];
        $result2 = $row['number'];
        $result3 = $row['link_adress'];

        $hotel = $row['hotel_id'];
        $a = str_replace('"', '', $result3);


        $space = "   ";
        echo "<h1 ><img src=" . $result . "  width=\"150\" height=\"150\"/> <h2>$result1 &nbsp; $result2 TL </h2><a href='?ekle=$hotel'>[Add to Basket]</a><a href='$a'>[Go to website]</a><br>";
    }

} else if (isset($_POST['search1'])) {
    $txtStartDate = $_POST['txtStartDate'];
    $txtEndDate = $_POST['txtEndDate'];
    $location = $_POST['submit1'];

    $query = mysqli_query($conn, "Select * from hotels Where hotel_location='$location' and CheckInDate>='$txtStartDate' and CheckOutDate<='$txtEndDate'");
    $count = mysqli_num_rows($query);


    if ($count == "0") {
        echo '<h2>There are no hotels between these dates!</h2>';
    } else {
        $count = 0;
        while ($row = mysqli_fetch_array($query)) {
            $result = $row['hotel_img'];
            $result1 = $row['hotel_name'];
            $result2 = $row['hotel_price'];
            $result3 = $row['link_adress'];
            $hotel = $row['hotel_id'];
            $a = str_replace('"', '', $result3);


            #$rest = substr($result2,0, -3);
            #$num = (float)$rest;
            #$array[] = $num;
            #sort($array);
            echo "<h1 ><img src=" . $result . "  width=\"150\" height=\"150\"/> <h2>$result1 &nbsp; $result2  </h2><a href='?ekle=$hotel'>[Add to Basket]</a><a href='$a'>[Go to website]</a><br>";

            $count++;

        }
    }

}
?>
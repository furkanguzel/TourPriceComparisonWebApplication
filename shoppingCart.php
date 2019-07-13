<?php
$hostname = "localhost";
$dbname = "csv";
$Username = "root";
$Password = "";

$conn = mysqli_connect($hostname, $Username, $Password, $dbname);
$conn1 = mysqli_connect($hostname, $Username, $Password, $dbname);
$conn2 = mysqli_connect($hostname, $Username, $Password, $dbname);


/*Sepetimi Goster*/
if(isset($_GET['sepetim'])){
    if (!empty($_COOKIE['hotel']) || !empty($_COOKIE['flight']) || !empty($_COOKIE['tour'])) {
        echo '<h2>Your Shopping Cart.</h2>';

        //echo '<h2>Sepetiniz('.sizeof($_COOKIE['hotel']).' + '.sizeof($_COOKIE['flight']).' + '.sizeof($_COOKIE['tour']).')</h2>';
    }
    $sql = mysqli_query($conn, "SELECT hotel_id,hotel_img,hotel_name ,LEFT(hotel_price,length(hotel_price)-3) as number FROM hotels");
    $sql1 = mysqli_query($conn1, "SELECT flight_id,flight_img,flight_name,depLand_time1,city1,airport1,depLandtime2,city2,airport2,LEFT(price,length(price)-3) as number1 FROM flights");
    $sql2 = mysqli_query($conn2, "SELECT *,LEFT(price,length(price)-3) as number2 FROM tours");

    $total = 0.0;
    while ($row = mysqli_fetch_array($sql)) {
        $result = $row['hotel_img'];
        $result1 = $row['hotel_name'];
        $result2 = $row['number'];
        $hot_id = $row['hotel_id'];
        if(isset($_COOKIE['hotel'])){
            foreach($_COOKIE['hotel'] as $cookiehotel=>$val) { #$cookiehotel : indis ,val : id
                if($hot_id==$val) {
                    $float = floatval(str_replace(',', '.', str_replace('.', '', $result2)));
                    $total = $total + $float * 7;
                    echo '<div style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px">
                          <h1><img src=' . $result . '  width=\"100\" height=\"100\"/> <h2>' . $result1 . ' &nbsp; ' . $result2 . ' TL </h2><a href=?cikart='.$hot_id.'>[Remove from my shopping cart.]</a><br>
                          </div>';

                }
            }
        }
    }
    $totalFlightTour = 0;
    $total1 = 0;
    while ($row1 = mysqli_fetch_array($sql1)) {
        $result = $row1['flight_img'];
        $result1 = $row1['flight_name'];
        $result2 = $row1['depLand_time1'];
        $result3 = $row1['city1'];
        $result4 = $row1['airport1'];
        $result5 = $row1['depLandtime2'];
        $result6 = $row1['city2'];
        $result7 = $row1['airport2'];
        $result8 = $row1['number1'];
        $flight_id = $row1['flight_id'];
        if(isset($_COOKIE['flight'])){
            foreach($_COOKIE['flight'] as $cookiehotel=>$val) { #$cookiehotel : indis ,val : id
                if($flight_id==$val) {
                    $float = floatval(str_replace(',', '.', str_replace('.', '', $result8)));
                    $total1 = $total + $float;
                    $totalFlightTour  = $totalFlightTour  + $float;

                    echo '<div style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px">
                          <h1 ><img src=' . $result . '  width=\"100\" height=\"100\"/> <h2>'.$result1.' &nbsp;'. $result2.' &nbsp; '.$result3.' &nbsp; '.$result4.' &nbsp; '.$result5.' &nbsp; '.$result6.' &nbsp; '.$result7.' &nbsp; '.$result8.' </h2><a href=?cikart1='.$flight_id.'>[Remove from my shopping cart.]</a><br>
                          </div>';
                }
            }
        }
    }
    $totalTour = 0;
    while ($row = mysqli_fetch_array($sql2)) {
        $result = $row['tour_img'];
        $result1 = $row['tour_name'];
        $result2 = $row['number2'];
        $tour_id = $row['tour_id'];
        if(isset($_COOKIE['tour'])){
            foreach($_COOKIE['tour'] as $cookiehotel=>$val) { #$cookiehotel : indis ,val : id
                if($tour_id==$val) {
                    $float = floatval(str_replace(',', '.', str_replace('.', '', $result2)));
                    $total2 = $total1 + $float;
                    $totalFlightTour2  = $totalFlightTour  + $float;
                    $totalTour = $totalTour  + $float;
                    echo '<div style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px">
                          <h1><img src=' . $result . '  width=\"100\" height=\"100\"/> <h2>' . $result1 . ' &nbsp; ' . $result2 . ' TL </h2><a href=?cikart2='.$tour_id.'>[Remove from shopping cart]</a><br>
                          </div>';
                }
            }
        }
    }
    if(empty($_COOKIE['hotel']) && empty($_COOKIE['flight']) && empty($_COOKIE['tour']) ){
        echo 'There are no products in your shopping cart right now!<br>' ;
    }
    if(!empty($_COOKIE['hotel']) && empty($_COOKIE['flight']) && empty($_COOKIE['tour']) ){
        echo 'Total price:', $total , ' TL';
    }
    if(!empty($_COOKIE['hotel']) && !empty($_COOKIE['flight']) && empty($_COOKIE['tour']) ){
        echo 'Total price:', $total1 , ' TL';
    }
    if(!empty($_COOKIE['hotel']) && empty($_COOKIE['flight']) && !empty($_COOKIE['tour']) ){
        echo 'Total price:', $float , ' TL';
    }
    if(!empty($_COOKIE['hotel']) && !empty($_COOKIE['flight']) && !empty($_COOKIE['tour']) ){
        echo 'Total price:', $total2 , ' TL';
    }
    if(empty($_COOKIE['hotel']) && !empty($_COOKIE['flight']) && !empty($_COOKIE['tour']) ){
        echo 'Total price:', $totalFlightTour2  , ' TL';

    }
    if(empty($_COOKIE['hotel']) && empty($_COOKIE['flight']) && !empty($_COOKIE['tour']) ){
        echo 'Total price:', $totalTour  , ' TL';

    }



}else{
    /*ürünleri listele*/

    /*sepete ürün ekle*/
    if(isset($_GET['ekle'])){
        $id = $_GET['ekle'];
        setcookie('hotel['.$id.']',$id,time() + 86400);
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    if(isset($_GET['added'])){
        $id1 = $_GET['added'];
        setcookie('flight['.$id1.']',$id1,time() + 86400);
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    if(isset($_GET['added1'])){
        $id = $_GET['added1'];
        setcookie('tour['.$id.']',$id,time() + 86400);
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    /*sepette kaç ürün var*/

    if(isset($_COOKIE['flight']) && isset($_COOKIE['hotel']) && isset($_COOKIE['tour']))
        echo 'There are<strong>('.count($_COOKIE['hotel']).'+'.count($_COOKIE['flight']).'+'.count($_COOKIE['tour']).')</strong>products in your shopping cart.<a href="?sepetim=true">[Show my shopping cart.]</a><a href="?bosalt=true">[Clear my shopping cart.]</a>' ;
    elseif(isset($_COOKIE['hotel']))
        echo 'There are<strong>('.count($_COOKIE['hotel']).')</strong>products in your shopping cart.<a href="?sepetim=true">[Show my shopping cart.]</a><a href="?bosalt=true">[Clear my shopping cart.]</a>' ;
    elseif(isset($_COOKIE['flight']))
        echo 'There are<strong>('.count($_COOKIE['flight']).')</strong>products in your shopping cart.<a href="?sepetim=true">[Show my shopping cart.]</a><a href="?bosalt=true">[Clear my shopping cart.]</a>' ;
    elseif(isset($_COOKIE['tour']))
        echo 'There are<strong>('.count($_COOKIE['tour']).')</strong>products in your shopping cart.<a href="?sepetim=true">[Show my shopping cart.]</a><a href="?bosalt=true">[Clear my shopping cart.]</a>' ;

    else
        echo 'You have no items in your shopping cart.';

    /*sepeti bosalt*/
    if(isset($_GET['bosalt'])){
        foreach($_COOKIE['hotel'] as $key => $val){
            setcookie('hotel['.$key.']',$key,time() -  86400);
        }
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    if(isset($_GET['bosalt'])){
        foreach($_COOKIE['flight'] as $key => $val){
            setcookie('flight['.$key.']',$key,time() -  86400);
        }
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    if(isset($_GET['bosalt'])){
        foreach($_COOKIE['tour'] as $key => $val){
            setcookie('tour['.$key.']',$key,time() -  86400);
        }
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    /*sepetten cikart*/
    if(isset($_GET['cikart'])){
        setcookie('hotel['.$_GET['cikart'].']',$_GET['cikart'],time() -  86400);
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    if(isset($_GET['cikart1'])){
        setcookie('flight['.$_GET['cikart1'].']',$_GET['cikart1'],time() -  86400);
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
    if(isset($_GET['cikart2'])){
        setcookie('tour['.$_GET['cikart2'].']',$_GET['cikart2'],time() -  86400);
        header('Location:'.$_SERVER['HTTP_REFERER']);
    }
}

?>
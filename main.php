<!DOCTYPE html>
<html>
<body>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />



<img src="lastpicture.jpg" alt="">

<div id="col1">

    <h1>Hotel Price Searching System</h1>

    <form method="post">
        <input  type="search" name="submit1"  value="<?php if(isset($_POST['submit1'])) echo ($_POST['submit1']); ?>" /> <br><br>

        <input type="date" name = "txtStartDate" value="<?php echo $_POST['txtStartDate']; ?>" />
        <input type="date" name = "txtEndDate" value="<?php echo $_POST['txtEndDate']; ?>" />

        <p>
            <input type="submit" name="search1" value="Most Popular ..!">
            <input type="submit" name="inc" value="Price Increasing ..!">
            <input type="submit" name="dec" value="Price decreasing ..!">
        </p>
    </form>


</div>
<div id="col2">

    <h1>Flight Price Searching System</h1>


    <form method="post">
        <input  type="search" name="submit2" value="<?php if(isset($_POST['submit2'])) echo ($_POST['submit2']); ?>" />
        <input  type="search" name="submit3" value="<?php if(isset($_POST['submit3'])) echo ($_POST['submit3']); ?>" /><br><br>

        <input type="date" name = "inDate" value="<?php echo $_POST['inDate']; ?>" />
        <input type="date" name = "outDate" value="<?php echo $_POST['outDate']; ?>" />
        <p>
            <input type="submit" name="increase" value="Price Increasing ..!">
            <input type="submit" name="decrease" value="Price decreasing ..!">
        </p>
    </form>
</div>

<div id="col3">
    <head>
        <h1>Tour Price Searching System</h1>

    </head>

    <form method="post">
        <input  type="search" name="submit4" value="<?php if(isset($_POST['submit4'])) echo ($_POST['submit4']); ?>"><br><br>

        <input type="date" name = "txtStartDate" value="<?php echo $_POST['txtStartDate']; ?>" />
        <input type="date" name = "txtEndDate" value="<?php echo $_POST['txtEndDate']; ?>" />
        <p>
            <input type="submit" name="search2" value="Most Popular ..!">
            <input type="submit" name="increase1" value="Price Increasing ..!">
            <input type="submit" name="decrease1" value="Price decreasing ..!">
        </p>
    </form>
</div>

<style>
    #col1 {
        display: inline-block;
        width:35%;
    }

    #col2 {
        display: inline-block;
        width:33%;
    }
    #col3 {
        display: inline-block;
        width:30%;
    }

</style>

</body>
</html>
<center>

<?php

require "hotel.php";
require "flight.php";
require "tour.php";
require "shoppingCart.php";

?>

</center>
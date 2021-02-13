<!DOCTYPE html>
<html>
<head>
<style>
    .empt{
        height: 75px;
    }
</style>
</head>
<body>

<?php
#$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','parkinglots');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}


mysqli_select_db($con,"parkinglots");
$sql="SELECT * FROM parkinglots.lot1";
$check = "SELECT COUNT(*) FROM parkinglots.lot1";
$result = mysqli_query($con,$sql);
$check1 = mysqli_query($con,$check);
$row = $check1->fetch_array()[0];
if(intval($row) == 0)
    {
       echo "<h1>I think the Monitoring server is offline or maybe starting please wait you will see the UI in a while</h1>";
    }
else {
echo "<div class='col-12'></br></div>
<div class='col-12'></br></div>";
$count = 1;
while($row = mysqli_fetch_array($result)) {
    if(strcmp($row['STATUS'],"False") == 0 and $count <= 100){
        echo "<div class='col-3 text-bold-400 empt text-size-s2 m-5 text-black text-center bg-danger' >" . $row['ID'] . "</div>";
        $count = $count + 1;
    }
    elseif(strcmp($row['STATUS'],"True") == 0 and $count <= 100){
        echo "<div class='col-3 text-bold-400 text-size-s2 empt m-5 text-black text-center bg-success' >" . $row['ID'] . "</div>";
        $count = $count + 1;        
    }
    else{
        echo "<div class='w-100'></div>";
        $count = 1;
    }
}
echo "</div>";
}
mysqli_close($con);
?>
</body>
</html>
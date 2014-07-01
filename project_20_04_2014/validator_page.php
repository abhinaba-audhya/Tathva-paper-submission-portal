<?php session_start();
ob_start();
?>
</head>

<body>
<div class="success">Welcome , <?php echo $_SESSION['Username']    ; ?></div>
<br><br><br>
 <br><br><br>
</body>
</html>
<?php
session_start();
ob_start();
if(!isset($_SESSION['Username']))
{
    header("Location: login.php");
}

include ('database_connection.php');
$id=$_SESSION['Memberid'];
$result=mysqli_query($dbc,"SELECT * FROM User_Paper WHERE P_Id IN (SELECT P_Id FROM Validator_Paper WHERE Chk_Bit=0 AND Valid_Bit=0)");
$i = 1;
echo "<table cellpadding='3' cellspacing='5'>";
$_SESSION['p_id']=array();
while ($get = mysqli_fetch_assoc($result))
{
    $Link="Paper/".$get['Upload'];
    $_SESSION['p_id'][$i.".valid"]=$get['P_Id'];
    $_SESSION['p_id'][$i.".invalid"]=$get['P_Id'];
    //echo $_SESSION['p_id'][$i.'.valid'];
    //echo $_SESSION['p_id'][$i.'.invalid'];
    echo '<tr><td>'.$i.'</td><td><a href='.$Link.'>'.$get["Upload"].'</a></td><td><form name="valid" value="valid" method="POST"><input type="submit" value='.$i.'.valid name="valid"><input type="submit" value='.$i.'.invalid name="invalid"></form></td></tr>';
    $i++;
}
echo "</table>";
function Forward_Paper()
{
    include ('database_connection.php');
}

function Sends_Acknowledgement()
{
    include ('database_connection.php');
}

function Validate_Paper($i)
{
    $id=intval($_SESSION['p_id'][$i]);
   // echo $id;
    include ('database_connection.php');
    //$id=$_SESSION['p_id'];
    
    $result=mysqli_query($dbc,"update Validator_Paper set Valid_Bit=1,Chk_Bit=1 where P_Id='$id' ");
    $result2=mysqli_query($dbc,"update User set Ack=2 where Memberid='$id'");
    $result3=mysqli_query($dbc,"insert into Judge_Paper(P_Id) values ('$id')");
     header("Location: validator_page.php");
    
}
function Invalidate_Paper($i)
{
    $id=intval($_SESSION['p_id'][$i]);
    //echo $id;
    include ('database_connection.php');
    $result=mysqli_query($dbc,"delete from Validator_Paper where P_Id='$id' ");
    $result2=mysqli_query($dbc,"update User set Ack=3 where Memberid='$id'");
    $result3=mysqli_query($dbc,"delete from User_Paper where P_Id='$id'");
     header("Location: validator_page.php");
    
}
if(isset($_POST['valid']))
{
    //echo "one";
    $i=$_POST['valid'];
    Validate_Paper($i);
}
else if(isset($_POST['invalid']))
{
    //echo "two";
    $i=$_POST['invalid'];
    Invalidate_Paper($i);
}
if(isset($_POST['logout']))
    {
        session_destroy();
     header("Location: login.php");
     }

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Area </title>
<style type="text/css">
 .success {
	border: 1px solid;
	margin: 0 auto;
	padding:10px 5px 10px 60px;
	background-repeat: no-repeat;
	background-position: 10px center;
     font-weight:bold;
     width:450px;
     color: #4F8A10;
	background-color: #DFF2BF;
	background-image:url('images/success.png');
     
}



</style>
</head>

<body>
 <br><br><br>
 <form name="logout" method="POST">
 <input type=submit value="logout" name="logout">
 <br><br>
 </form>
</body>
</html>


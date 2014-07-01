<?php
	//ob_start();
    session_start();
    if(!isset($_SESSION['Username'])){
         header("Location: login.php");
    }
    include ('database_connection.php');
    $Ack="";
    $Result="";
    function Receive_Acknowledgement()
    {
        include ('database_connection.php');
    $id=$_SESSION['Memberid'];
    //echo $id;
    $result=mysqli_query($dbc,"select Ack from User where Memberid='$id'");
    $row=mysqli_fetch_assoc($result);
    $k=$row['Ack'];
    if($k==0)
        $GLOBALS["Ack"]="Please Submit Paper";
    else if($k==1)
        $GLOBALS["Ack"]="Paper yet to be acknowledged";
    else if($k==2)
        $GLOBALS["Ack"]="Paper not valid. Please Resubmit";
    else
        $GLOBALS["Ack"]="Paper Accepted";
    //echo $Ack;
    }
    function viewResult()
    {
        include ('database_connection.php');
        $result=mysqli_query($dbc,"select Result from Competition where C_Id='1'");
    $row=mysqli_fetch_assoc($result);
    $GLOBALS["Result"]=$row['Result'];
    //echo $Result;
    }
    viewResult();
    Receive_Acknowledgement();
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
<div class="success">Welcome , <?php echo $_SESSION['Username']	; ?></div>
<br><br><br>
<form enctype="multipart/form-data" action="add.php" method="POST"> 
 Name: <input type="text" name="name"><br> 
 Topic: <input type="text" name = "topic"><br> 
 Pdf: <input type="file" name="up"><br> 
 <input type="submit" value="Add"> 
 </form>
 <br><br>
 Acknowledgement : <input type=textbox value="<?php echo $Ack?>" size=50><br>
 Result : <input type=textbox value="<?php echo $Result ?>" size=50>
 <br><br><br>
 <form name="logout" method="POST">
 <input type=submit value="logout" name="logout">
 <br><br>
 </form>
</body>
</html>

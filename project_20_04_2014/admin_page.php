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
function chk_judge()
{
    include ('database_connection.php');
    $result=mysqli_query($dbc,"select * from Competition where (Judge1_chk=1 and Judge2_chk=1) and Judge3_chk=1");
    if(mysqli_num_rows($result) > 0)
    {
        return 1;
    }
    else
    return 0;
}
function add_marks()
{
    include ('database_connection.php');
    $id=$_SESSION['Memberid'];
    $result=mysqli_query($dbc,"SELECT * FROM User u,Judge_Paper j,User_Paper p WHERE u.Memberid=j.P_Id and u.Memberid=p.P_Id");
    
    $i = 1;
    echo "<table cellpadding='3' cellspacing='5'>";
    $_SESSION['p_id']=array();
    $max1=0;
    $max2=0;
    $max3=0;
    while ($get = mysqli_fetch_assoc($result))
    {
        $id1=$get['Username'];
        $pid=$get['P_Id'];
        $Link="Paper/".$get['Upload'];
        /*$_SESSION['p_id'][$i.".valid"]=$get['P_Id'];
        $_SESSION['p_id'][$i.".invalid"]=$get['P_Id'];*/
        //echo $_SESSION['p_id'][$i.'.valid'];
        //echo $_SESSION['p_id'][$i.'.invalid'];
        $total=$get['Judge_1']+$get['Judge_2']+$get['Judge_3'];
        if(intval($total)>=$max1)
        {
            $max1=intval($total);
            $_SESSION['1_nm']=$id1;
            $_SESSION['1_id']=$get['Memberid'];
            $_SESSION['1_tot']=$total;
            //$_SESSION[]=;
            //$_SESSION[]=;
            
        }
        mysqli_query($dbc,"update Judge_Paper set Total='$total' where P_Id='$pid'");
        echo '<tr><td>'.$i.'</td><td> '.$id1.' </td><td><a href='.$Link.'>'.$get["Upload"].'</a></td><td>Total Marks : '.$total.'</td></tr>';
        $i++;
        $total=0;
    }
    echo "</table>";
    $result=mysqli_query($dbc,"SELECT * FROM User u,Judge_Paper j,User_Paper p WHERE u.Memberid=j.P_Id and u.Memberid=p.P_Id");
    while ($get = mysqli_fetch_assoc($result))
    {
        $id1=$get['Username'];
        $pid=$get['P_Id'];
        $total=$get['Judge_1']+$get['Judge_2']+$get['Judge_3'];
        if(intval($total)>=$max2 && $pid!=$_SESSION['1_id'])
        {
            $max2=intval($total);
            $_SESSION['2_nm']=$id1;
            $_SESSION['2_id']=$get['Memberid'];
            $_SESSION['2_tot']=$total;
        }
        $total=0;
    }
    $result=mysqli_query($dbc,"SELECT * FROM User u,Judge_Paper j,User_Paper p WHERE u.Memberid=j.P_Id and u.Memberid=p.P_Id");
    while ($get = mysqli_fetch_assoc($result))
    {
        $id1=$get['Username'];
        $pid=$get['P_Id'];
        $total=$get['Judge_1']+$get['Judge_2']+$get['Judge_3'];
        if(intval($total)>=$max3 && $pid!=$_SESSION['1_id'] && $pid!=$_SESSION['2_id'])
        {
            $max3=intval($total);
            $_SESSION['3_nm']=$id1;
            $_SESSION['3_id']=$get['Memberid'];
            $_SESSION['3_tot']=$total;
        }
        $total=0;
    }
    /*echo $_SESSION['1_nm'];
    echo $_SESSION['2_nm'];
    echo $_SESSION['3_nm'];*/
    
    //mysqli_query($dbc,"update Competition set ");
}
function publish_result()
{
    include ('database_connection.php');
    $msg="Result Declared.Check you email.  1. ".$_SESSION['1_nm']."    2. ".$_SESSION['2_nm']."    3. ".$_SESSION['3_nm']." ";
    mysqli_query($dbc,"update Competition set Result='$msg' where C_Id='1'");
}

function Sends_Acknowledgement()
{
    include ('database_connection.php');
}


if(chk_judge()==1)
{
    add_marks();
    //header("Location: login.php");
    
}
else if(chk_judge()==0)
{
    echo "Some Paper not yet judged ";
}
if(isset($_POST['publish']))
{
    publish_result();
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
<br><br>
<form name="publish" method="POST">
 <input type=submit value="publish" name="publish">
 </form>
 <br><br><br>
 <form name="logout" method="POST">
 <input type=submit value="logout" name="logout">
 <br><br>
 </form>
</body>
</html>


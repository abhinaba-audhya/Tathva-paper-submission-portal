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
function chk_date()
{
    include ('database_connection.php');
    $present_date=date("Y-m-d");
    $present_date=new DateTime($present_date);
    $result=mysqli_query($dbc,"select End_Date from Competition where C_Id='1'");
    $row = mysqli_fetch_assoc($result);
    $my_date=$row['End_Date'];
    $end_date = date('Y-m-d', strtotime($my_date));
    $end_date = new DateTime($end_date);
    //echo $present_date;
    //echo $end_date;
    $nonabsolute = $end_date->diff($present_date);
    if($nonabsolute->format('%R%a')>0)
        return 1;
    else return 0;
    
}
function get_paper()
{
    include ('database_connection.php');
    $id=$_SESSION['Memberid'];

    $permission=$_SESSION['Permission'];
    if($permission=='1')
        $result=mysqli_query($dbc,"SELECT * FROM Judge_Paper j,User_Paper u where j.Judge_1=0 AND j.P_Id=u.P_Id");
    else if($permission=='2')
        $result=mysqli_query($dbc,"SELECT * FROM Judge_Paper j,User_Paper u where j.Judge_2=0 AND j.P_Id=u.P_Id");
    else if($permission=='3')
        $result=mysqli_query($dbc,"SELECT * FROM Judge_Paper j,User_Paper u where j.Judge_3=0 AND j.P_Id=u.P_Id");

    $i = 1;
    echo "<table cellpadding='3' cellspacing='5'>";
    $_SESSION['p_id']=array();
    while ($get = mysqli_fetch_assoc($result))
    {
        $Link="Paper/".$get['Upload'];
        $_SESSION['p_id'][$i.".judged"]=$get['P_Id'];
        //echo $_SESSION['p_id'][$i.'.valid'];
        //echo $_SESSION['p_id'][$i.'.invalid'];
        echo '<tr><td>'.$i.'</td><td><a href='.$Link.'>'.$get["Upload"].'</a></td><td><form name="judged" value="judged" method="POST"><input type="textbox" value=0 name="marks"><input type="submit" value='.$i.'.judged name="judged"></form></td></tr>';
        $i++;
    }
    echo "</table>";
    return set_judged();
}
function set_judged()
{
    include ('database_connection.php');
    $permission=$_SESSION['Permission'];
    if($permission=='1')
        $result=mysqli_query($dbc,"SELECT * FROM Judge_Paper where Judge_1=0");
    else if($permission=='2')
        $result=mysqli_query($dbc,"SELECT * FROM Judge_Paper where Judge_2=0");
    else if($permission=='3')
        $result=mysqli_query($dbc,"SELECT * FROM Judge_Paper where Judge_3=0");
        if(mysqli_num_rows($result)==0)
        {
            $permission=$_SESSION['Permission'];
            if($permission=='1')
                $result=mysqli_query($dbc,"update Competition set Judge1_chk=1 where C_Id='1'");
            else if($permission=='2')
                $result=mysqli_query($dbc,"update Competition set Judge2_chk=1 where C_Id='1'");
            else if($permission=='3')
                $result=mysqli_query($dbc,"update Competition set Judge3_chk=1 where C_Id='1'");
            return $permission;
        }
        else
            return -1;
    
}

function judge_paper($k,$i)
{
    $id=intval($_SESSION['p_id'][$k]);
   // echo $id;
    include ('database_connection.php');
    //$id=$_SESSION['p_id'];
    
    $permission=$_SESSION['Permission'];
    if($permission=='1')
        $result=mysqli_query($dbc,"update Judge_Paper set Judge_1 = $i where P_Id='$id' ");
    else if($permission=='2')
        $result=mysqli_query($dbc,"update Judge_Paper set Judge_2 = $i where P_Id='$id' ");
    else if($permission=='3')
        $result=mysqli_query($dbc,"update Judge_Paper set Judge_3 = $i where P_Id='$id' ");
     header("Location: judge_page.php");
    
}

if(isset($_POST['judged']))
{
    //echo "one";
    $k=$_POST['judged'];
    $i=intval($_POST['marks']);
    judge_Paper($k,$i);
}

if(isset($_POST['logout']))
    {
        session_destroy();
     header("Location: login.php");
     }
//if(chk_date()==1)
//{
    if(get_paper()!=-1)
    {
       echo "All Paper Judged";
    }
    
//}
//else
   // echo "Competition still going on.";


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


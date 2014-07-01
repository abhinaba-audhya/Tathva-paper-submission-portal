<?php 
 session_start();
 ob_start();
 if(isset($_SESSION['Memberid']))
 {  
     //$error=array();
     include("database_connection.php");
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
        echo 'Competition Over';
        else
        {
 //This is the directory where images will be saved 
 $target = "Paper/"; 
 $target = $target . basename( $_FILES['up']['name']); 
 
 //This gets all the other information from the form 
 $name=$_POST['name']; 
 $topic=$_POST['topic']; 
 $pdf=($_FILES['up']['name']); 
 // Connects to your Database 
 mysql_connect("papersubmission.db.11374925.hostedresource.com", "papersubmission", "George@91") or die(mysql_error()) ; 
 mysql_select_db("papersubmission") or die(mysql_error()) ; 
 
 $a=1;
 $id=$_SESSION['Memberid'];
 //checks whthr any paper already uploaded
 $result=mysqli_query($dbc,"select Ack from User where Memberid='$id'");
 $row=mysqli_fetch_assoc($result);
 if($row['Ack']==1 || $row['Ack']==2)
 {
    echo "Sorry. You have already submitted a paper.";   
 }
 else
 {
 //Writes the information to the database 
 mysql_query("INSERT INTO `User_Paper`(Memberid,P_Id,Topic,Upload) VALUES ('$id','$id','$topic', '$pdf')") ; 
 mysql_query("UPDATE User set Ack='1' where Memberid='$id'"); 
 $result=mysql_query("Select P_Id from `User_Paper`where Memberid='$id'") ;  
 $row = mysql_fetch_array($result);
 $P_Id=$row['P_Id'];
 mysql_query("INSERT INTO `Validator_Paper`(P_Id) VALUES ('$P_Id')") ; 
 //Writes the photo to the server 
 if(move_uploaded_file($_FILES['up']['tmp_name'], $target)) 
 { 
 
 //Tells you if its all ok 
 echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded, and your information has been added to the directory"; 
 } 
 else { 
 
 //Gives and error if its not 
 echo "Sorry, there was a problem uploading your file."; 
 }
 }
 }
 if(isset($_POST['back']))
 {
     header("Location: page.php");
 }
        
 }
?>
 <html>
 <body>
 <br><br><br>
 <form name="back" method="POST">
 <input type=submit value="back" name="back">
 </form>
 </body>
 </html>
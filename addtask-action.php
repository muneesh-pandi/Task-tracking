<?php
session_start();
include_once("common/database.class.php");
include_once("common/common.class.php");
include_once("common/db_config.php");
include_once("common/globals.php");
$db=new database;
$error=$_REQUEST['msg'];
   $id= $_SESSION['id'];
 
?>
<?php

if($_POST)
{
  
  $title = $_POST['news_title'];
     $desc = $_POST['news_desc'];
	  $ndate = $_POST['news_date'];
 


 $sql="select max(categoryid) as maxid from category";
		$result=$db->get_a_line($sql);
		 $newid=$result[maxid]+1;
		 
 
  	 $ns="insert into category set categoryid='$newid', categoryname='$title',  description='$desc', postdate='$ndate', galleryid='$id'";
	 
   	$db->insert($ns);

 	if($ns)
	{
	
	$mnews= ' <div class="alert alert-success alert-dismissible fade in margtop10   " align="center"  role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Success!</strong> News has been added. &nbsp;&nbsp;
</div>'; 
  		    
		  

        }
        else
        {
 			
			 	     		$mnews= '   <div class="alert alert-warning alert-dismissible fade in margtop10   " align="center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Error!</strong> Please try again. &nbsp;&nbsp;
</div>
'; 
   	
		}
}

 ?>

      <div class="col-md-12 " align="center">
	 <?php  echo  $mnews;
	 include"addnews-table.php";  ?>  



 </div>

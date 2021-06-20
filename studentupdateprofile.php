<?php
session_start();
$S_id=$_SESSION["Reg_id"];
$S_Name=$_SESSION["S_Name"];

require_once("classes/FormAssist.class.php");
require_once("classes/DataAccess.class.php");
require_once("classes/FormValidator.class.php");
$dao=new DataAccess();

$rules= array("name"=>array("required"=>"","minlength"=>3,"maxlength"=>20,"alphaspaceonly"=>"","nospecchars"=>""),
               
				"email"=>array("required"=>"","email"=>""),
				
				
				);

$labels=array("name"=>"", "email"=>"");
$validator=new FormValidator($rules,$labels);
if(isset($_POST["reg"]))
{
  if($validator->validate($_POST))
  {

       $data = array("S_Name"=>$_POST["name"],"S_Email"=>$_POST["email"]);

        if($dao->update($data,"std_registration","Reg_id=$S_id"))
        {


        //header("location:index.php");
          $msg="Updated";

        }
        else
        {    
            $msg="Failed ,please try again";
        }
  }
  else
  {
  $msg="Failed ,val error";
  //var_dump($dao->getQuery());

  }
}

$res=$dao->getData("*","tr_registration","Reg_id=$S_id");
$details=$res[0];
$fields=array("name"=>$details["S_Name"],"email"=>$details["S_Email"]);
$form=new FormAssist($fields,$_POST);



?>
<!DOCTYPE html>
<html>
<head>

    <title>Teacher</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<style>
		table,td,th
		{
			
		}
		table
		{
			border-collapse: collapse;
			margin: 0 auto;
			width:80%;
		}
		td,th
		{
			text-align: center;
			border-radius: 10px 10px 10px 10px;
			height:40px;
		}
		tr:nth-child(even)
		{
			background-color:#c3e4d4;
		}
		tr:nth-child(odd)
		{
			background-color: powderblue;
		}
		tr:nth-child(1)
		{
			background-color: gray;
		}
		</style>
</head>
<body>
	<input type="checkbox" id="checkbox">
	<header class="header">
		<h2 class="u-name"><b><em>Student</em></b>
			<label for="checkbox">
				<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
			</label>
		</h2>
		<i class="fa fa-user" aria-hidden="true"></i>
	</header>
	<div class="body">
		<nav class="side-bar">
			<div class="user-p">
				<img src="assets/img/user.jpg">
				<h4>Welcome <b><?php echo strtoupper($S_Name)?></b></h4>
			</div>
			<ul>
				<li>
					<a href="adminhome.php">
						<i class="fa fa-desktop" aria-hidden="true"></i>
						<span>Profile</span>
					</a>
				</li>
				<li>
					<a href="downloadmaterials.php">
						<i class="fa fa-eye" aria-hidden="true"></i>
						<span>Materials</span>
					</a>
				</li>
				<li>
					<a href="viewteacher.php">
						<i class="fa fa-eye" aria-hidden="true"></i>
						<span> Exam</span>
					</a>
				</li>
				<li>
					<a href="viewAlert.php">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span>Notification</span>
					</a>
				</li>
				
				<li>
					<a href="">
						<i class="fa fa-comment-o" aria-hidden="true"></i>
						<span>Feedback</span>
					</a>
				</li>
				<li>
					<a href="logout.php">
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>
					</a>
				</li>
				
			</ul>
		</nav>
		</nav>
        <section class="section-1">
           
         
     
  <center><p style="color: black;font-family:satisfy">Update</p></center>
 
    <form method="post" enctype="multipart/form-data">
    
    
    <hr>
        <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <span class="fa fa-user"></span>
          </span>                    
        </div>
        <?php echo $form->textBox("name",array("placeholder"=>"Student Name","class"=>"form-control")); ?>
                  <font color=red size=2><?php echo $validator->error("name"); ?>
      </div>
        </div>
        
		
        <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">
            <i class="fa fa-paper-plane"></i>
          </span>                    
        </div>
        <?php echo $form->textBox("email",array("placeholder"=>"email","type"=>"email","class"=>"form-control")); ?>
                  <?php echo $validator->error("email"); ?>
      </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg" name="reg" value="Update" />
        </div>
    </form>

        </section>
   

</body>
</html>
<?php
session_start();
$T_id=$_SESSION["T_id"];
$T_N=$_SESSION["T_Name"];
if(!isset($_SESSION['T_Name']))
{
	header("location:teacher.php");
}

require_once("classes/FormAssist.class.php");
require_once("classes/DataAccess.class.php");
require_once("classes/FormValidator.class.php");
$dao=new DataAccess();

$rules= array("name"=>array("required"=>"","minlength"=>3,"maxlength"=>20,"alphaspaceonly"=>"","nospecchars"=>""),
               "phone"=>array("required"=>"","minlength"=>10,"maxlength"=>10 ,"integeronly"=>"",),
			    "subject"=>array("required"=>"","minlength"=>3,"maxlength"=>10),
				"email"=>array("required"=>"","email"=>""),
				
				
				);

$labels=array("name"=>"","phone"=>"","subject"=>"", "email"=>"");
$validator=new FormValidator($rules,$labels);
if(isset($_POST["reg"]))
{
  if($validator->validate($_POST))
  {

       $data = array("T_Name"=>$_POST["name"],"Phone"=>$_POST["phone"],"Subject_Taken"=>$_POST["subject"],"T_Email"=>$_POST["email"]);

        if($dao->update($data,"tr_registration","T_id=$T_id"))
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

$res=$dao->getData("*","tr_registration","T_id=$T_id");
$details=$res[0];
$fields=array("name"=>$details["T_Name"],"phone"=>$details["Phone"],"subject"=>$details["Subject_Taken"],"email"=>$details["T_Email"]);
$form=new FormAssist($fields,$_POST);



?>
<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Online Leaning Portal</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<meta charset="UTF-8">
  
  <link rel="icon" href="http://www.phpkida.com/wp-content/uploads/2015/11/phpkida-new-logo-150x150.png" sizes="32x32" />
<link rel="icon" href="http://www.phpkida.com/wp-content/uploads/2015/11/phpkida-new-logo.png" sizes="192x192" />
<link rel="apple-touch-icon-precomposed" href="http://www.phpkida.com/wp-content/uploads/2015/11/phpkida-new-logo.png" />
<meta name="msapplication-TileImage" content="http://www.phpkida.com/wp-content/uploads/2015/11/phpkida-new-logo.png" />

  
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
	
</head>
<body>
	<input type="checkbox" id="checkbox">
	<header class="header">
		<h2 class="u-name"><b><em>GUIDE</em></b>
			<label for="checkbox">
				<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
			</label>
		</h2>
		<i  class="fa fa-user" aria-hidden="true"> </i>
	</header>
	<div class="body">
		<nav class="side-bar">
			<div class="user-p">
				<img src="assets/img/user.jpg">
				<h4>HI, <?php echo strtoupper($T_N)?></h4>
			</div>
			<ul>
				<li>
					<a href="viewteacherprofile.php">
						<i class="fa fa-desktop" aria-hidden="true"></i>
						<span>Profile</span>
					</a>
				</li>
				<li>
					
						<i class="fa fa-university" aria-hidden="true"></i>
						<span>Academics</span>
					
				</li>
				<li>
					<a href="uploadmaterials.php">
						<i class="fa fa-plus" aria-hidden="true"></i>
						<span> Add materials</span>
					</a>
				</li>
				<li>
					<a href="viewmaterials.php">
						<i class="fa fa-eye" aria-hidden="true"></i>
						<span> View Materials</span>
					</a>
				</li>
				<li>
					<a href="uploadassignment.php">
						<i class="fa fa-plus" aria-hidden="true"></i>
						<span>Add Assignments</span>
					</a>
				</li>
				
				<li>
					<a href="viewfeedback.php">
						<i class="fa fa-comment-o" aria-hidden="true"></i>
						<span>Feedback</span>
					</a>
				</li>
				<li>
					<a href="notification.php">
						<i class="fa fa-comment-o" aria-hidden="true"></i>
						<span>Alert</span>
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
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">        
<div class="container">
<div class="card login-card">
<div class="row no-gutters"> 
<div class="col-md-11">
<div class="card-body">

                      
      
	<form method = "post" enctype="multipart/form-data">
    <center><p style="color: black;font-family:satisfy">Update</p></center>
 
    <div>
        <label for="name" class="sr-only">Teacher Name</label>
		
        <?php echo $form->textBox("name",array("placeholder"=>"Teacher Name","class"=>"form-control")); ?>
        <?php echo $validator->error("name"); ?>
	
	</div>
    <div>	
       
        <label for="name" class="sr-only">Contact Number</label>
        <?php echo $form->textBox("phone",array("placeholder"=>"Phone Number","class"=>"form-control")); ?>
        <?php echo $validator->error("phone"); ?>
        
	</div>
    <div>	
        
        <label for="name" class="sr-only">Subject</label>
        <?php echo $form->textBox("subject",array("placeholder"=>"Subject","class"=>"form-control")); ?>
        <?php echo $validator->error("subject"); ?>
       
	</div>
    <div>	
        
        <label for="name" class="sr-only">Email</label>
        <?php echo $form->textBox("email",array("placeholder"=>"email","type"=>"email","class"=>"form-control")); ?>
        <?php echo $validator->error("email"); ?>
		
    </div>   
    <div> 
	
        <input type="submit" class="btn btn-primary btn-lg" name="reg" value="Update" />
        
	</div>	
		
	</center>
	</form>
	</div>
	</div>
	</div>
	</div>
	</div>
	
 </main>   
</section>
		</div>
   <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</body>
</html>
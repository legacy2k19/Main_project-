<?php
session_start();

$T_id=$_SESSION["T_id"];
$T_N=$_SESSION["T_Name"];
if(!isset($_SESSION['T_Name']))
{
	header("location:teacher.php");
}
?>
<?php
require_once("classes/FormAssist.class.php");
require_once("classes/DataAccess.class.php");
require_once("classes/FormValidator.class.php");
$fields=array("sname"=>"","sub_id"=>"","mu"=>"");
$rules= array("sname"=>array("required"=>"","minlength"=>3,"maxlength"=>20),
			  "sub_id"=>array("required"=>"")
				
				);
$labels=array();
$validator=new FormValidator($rules,$labels);
$form=new FormAssist($fields,$_POST);
$dao=new DataAccess();
if(isset($_POST["upload"]))
{
	if($validator->validate($_POST))
	{
		
		if(isset($_FILES["mu"]))
        {
			
			require_once("classes/FileUpload.class.php");
			$upload= new FileUpload();
			$types=["application/vnd.openxmlformats-officedocument.presentationml.presentation","application/pdf"];
			if($file_name=$upload->doUpload($_FILES["mu"],$types,800,10,"materials"))
			{
				$data = array("Module"=>$_POST["sname"],"Materials"=>$file_name,"T_id"=>$T_id,"sub_id"=>$_POST["sub_id"]);
					
				if($dao->insert($data,"tbl_material"))
				{
					$msg="Success";
				}
				else
				{
				  
				  var_dump($dao->lastQuery());
				  $msg="Insertion failed";
 
				}
			}
			else
			{
		     $msg_file= $upload->errors();
			}
		}
		else
		{
			die("dfsdfsd");
		}
    }
	else
		{
			var_dump($dao->getErrors());
			$msg="validation";
		}
		
	
}
	

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
		</nav>
		<section class="section-1">
		<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
        <div class="card login-card">
        <div class="row no-gutters">
        
		<div class="col-md-7">
            <div class="card-body">
              
		  
					
					<form method = "post" enctype="multipart/form-data" >
					
					    <div class="div">
                   
						<?php $cats=$dao->createOptions("sub_name","sub_id","tbl_subject");
						echo $form->dropDownList("sub_id",array("class"=>"form-input"),$cats,"Select Subject");?>
						<font color=red size=2>
						<?php echo $validator->error("sub_id"); ?>

                        </div>
						
						
						<br>
						<div class="form-group mb-4">
						
						<?php echo $form->textBox("sname",array("placeholder"=>"Subject Module")); ?>
						<?php echo $validator->error("sname"); ?>
						</div>
						</br>
					    <div class="form-group mb-4">
						<?php echo $form->fileField("mu",array("placeholder"=>"Upload Materials ")); ?></td>
						<?php echo isset($msg_file)?$msg_file:""; ?>
						</div>
						<div class="form-group mb-4">
					  
						<input name="upload" id="upload" class="btn btn-block login-btn mb-4" type="submit" value="upload">
						</div>
						
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

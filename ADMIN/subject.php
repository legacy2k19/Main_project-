<?php
require_once("classes/FormAssist.class.php");
require_once("classes/DataAccess.class.php");
require_once("classes/FormValidator.class.php");
$fields=array("name"=>"");
$rules= array("name"=>array("required"=>"","minlength"=>3,"maxlength"=>10,"alphaspaceonly"=>"","nospecchars"=>""),
				
				);
$labels=array();
$validator=new FormValidator($rules,$labels);
$form=new FormAssist($fields,$_POST);
$dao=new DataAccess();
if(isset($_POST["submit"]))
{
	if($validator->validate($_POST))
	{
		
		
		$data = array("sub_name"=>$_POST["name"]);
					
		if($dao->insert($data,"tbl_subject"))
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
		die("dfsdfsd");
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
		<h2 class="u-name"><b>Admin</b>
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
				<h4>ADMIN</h4>
			</div>
			<ul>
				
				<li>
					<a href="viewstudent.php">
						<i class="fa fa-eye" aria-hidden="true"></i>
						<span>View Students</span>
					</a>
				</li>
				<li>
					<a href="viewteacher.php">
						<i class="fa fa-eye" aria-hidden="true"></i>
						<span> View Teachers</span>
					</a>
				</li>
				<li>
					<a href="subject.php">
						<i class="fa fa-plus" aria-hidden="true"></i>
						<span>Add Subject</span>
					</a>
				</li>
				<li>
					<a href="viewsubject.php">
						<i class="fa fa-eye" aria-hidden="true"></i>
						<span> View Subject</span>
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
		<section class="section-1">
		<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
        <div class="card login-card">
        <div class="row no-gutters">
        
		<div class="col-md-7">
            <div class="card-body">
              
            
              <form method = "post">
			        <div class="form-group">
                    <label for="name" class="sr-only">Subject Name</label>
                    <?php echo $form->textBox("name",array("placeholder"=>"Subject Name")); ?>
					<?php echo $validator->error("name"); ?>
                    </div>
                  <input name="submit" id="submit" class="btn btn-block login-btn mb-4" type="submit" value="ADD">
                
                
                
				
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
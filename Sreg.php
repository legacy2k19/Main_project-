<?php
require_once("classes/FormAssist.class.php");
require_once("classes/DataAccess.class.php");
require_once("classes/FormValidator.class.php");
$fields=array("name"=>"","class1"=>"", "email"=>"","paswd"=>"","cpaswd"=>"");
$rules= array("name"=>array("required"=>"","minlength"=>3,"maxlength"=>20,"alphaspaceonly"=>"","nospecchars"=>""),
				"email"=>array("required"=>"","email"=>"","unique"=>array("table"=>"tbl_login","field"=>"Email")),
				"class1"=>array("required"=>""),
				"paswd"=>array("required"=>"","compare"=>array("compareto"=>"email","operator"=>"!=")),
				"cpaswd"=>array("required"=>"","compare"=>array("compareto"=>"paswd","operator"=>"=")),
				
				);
$labels=array();
$validator=new FormValidator($rules,$labels);
$form=new FormAssist($fields,$_POST);
$dao=new DataAccess();
if(isset($_POST["register"]))
{
	if($validator->validate($_POST))
	{
		$data = array("S_Name"=>$_POST["name"],"S_Class"=>$_POST["class1"],"S_Email"=>$_POST["email"],"Status"=>"A");
				
		if($dao->insert($data,"std_registration"))
		{
			$data1=array("Email"=>$_POST["email"],"Password"=>md5($_POST["paswd"]),"Role_type"=>"s","Status"=>"a");
			if($dao->insert($data1,"tbl_login"))
			{
				header("location:login.php");
				$msg="Registered, please Login";				
			}
			else
			{
				$msg="Failed ,please try again";
			}
		}
		else
		{
			$msg="Failed ,please try again";
			//var_dump($dao->getQuery());
			
		}
	}
	else
	{
		$error=true;
	}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>register </title>
  
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
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="assets/images/reg.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              
              <h1 class="login-card-description">Register As Student</h1>
              <form method = "post">
			        <div class="form-group">
                    <label for="name" class="sr-only">Name</label>
                    <?php echo $form->textBox("name",array("placeholder"=>"Full Name")); ?>
					<?php echo $validator->error("name"); ?>
                    </div>
					
					<div class="form-group">
                    <label for="class1" class="sr-only">Class</label>
                    <?php echo $form->textBox("class1",array("placeholder"=>"Class","type"=>"class1")); ?>
					<?php echo $validator->error("class1"); ?>
                    </div>
					
                    <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <?php echo $form->textBox("email",array("placeholder"=>"Email","type"=>"email")); ?>
					<?php echo $validator->error("email"); ?>
                    </div>
					
                    <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <?php echo $form->passwordBox("paswd",array("placeholder"=>"Password")); ?>
					<?php echo $validator->error("paswd"); ?>
                    </div>
					
					<div class="form-group mb-4">
                    <label for="Confirm password" class="sr-only">Confirm Password</label>
                    <?php echo $form->passwordBox("cpaswd",array("placeholder"=>"ConfirmPassword")); ?>
					<?php echo $validator->error("cpaswd"); ?>
                    </div>
                  <input name="register" id="register" class="btn btn-block login-btn mb-4" type="submit" value="Sign Up">
                
                
                <center><h1 class="login-card-footer-text"><a href="login.php" class="text-reset">LOGIN</a>
				<a href="index.html" class="text-reset">HOME</a></h1></center>
				
             </form>   
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>


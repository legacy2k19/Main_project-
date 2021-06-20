<?php
require_once("classes/FormAssist.class.php");
require_once("classes/DataAccess.class.php");
require_once("classes/FormValidator.class.php");
require_once("classes/Authentication.class.php");

$fields=array("email"=>"","password"=>"");
$rules= array("email"=>array("required"=>"","minlength"=>3,"maxlength"=>30,"email"=>""),
        "password"=>array("required"=>"")   );
$labels=array("email"=>"Username","password"=>"Password");
$validator=new FormValidator($rules,$labels);
$form=new FormAssist($fields,$_POST);
$dao=new DataAccess();
$auth = new Authentication();
if(isset($_POST["login"]))
{
  if($validator->validate($_POST))
  {
      if($auth->authenticate($_POST["email"],$_POST["password"]))
      {
        session_start();
        $type = $auth->utype;
        if($type=="admin")
        {
          $_SESSION["admin"]=$_POST["email"];
		  
          header("location:admin.html");
         //$msg=$type;
        }
		
		else
		{
        $msg=$auth->error;
        }
	
		
      }
      else
      {
        $msg=$auth->error;
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login </title>
  
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
            <img src="assets/images/login.jpg" alt="login" class="login-card-img">
          </div>
		  
          <div class="col-md-7">
            <div class="card-body">
              
              <h1 class="login-card-description">Sign up</h1>
              <form method="post">
                  <div class="form-group">
				  
                    <?php echo $form->textBox("email",array("placeholder"=>"Email","type"=>"email")); ?>
                    <?php echo $validator->error("email"); ?>
					
                  </div>
                  <div class="form-group mb-4">
				  
                    <?php echo $form->passwordBox("password",array("placeholder"=>"Password")); ?>
                    <?php echo $validator->error("password"); ?>
					
                  </div>
				  <p><?php echo isset($msg)?$msg:""; ?></p>
				  
                  <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                </form>
                
                <h1 class="login-card-footer-text">Don't have an account?<br> <a href="Sreg.php" class="text-reset">" Student "</a>
				<a href="Treg.php" class="text-reset">" Teacher "</a></h1>
                
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

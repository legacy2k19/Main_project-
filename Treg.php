<?php
//var_dump($_FILES["ID"]);
require_once("classes/FormAssist.class.php");
require_once("classes/DataAccess.class.php");
require_once("classes/FormValidator.class.php");
$fields=array("name"=>"","ID"=>"","phone"=>"","subject"=>"","email"=>"","paswd"=>"","cpaswd"=>"");
$rules= array("name"=>array("required"=>"","minlength"=>3,"maxlength"=>20,"alphaspaceonly"=>"","nospecchars"=>""),
               "phone"=>array("required"=>"","minlength"=>10,"maxlength"=>10 ,"integeronly"=>""),
			    "subject"=>array("required"=>"","minlength"=>3,"maxlength"=>10),
				"email"=>array("required"=>"","email"=>"","unique"=>array("table"=>"tbl_login","field"=>"Email")),
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
		
		if(isset($_FILES["ID"]))
        {
			
			require_once("classes/FileUpload.class.php");
			$upload= new FileUpload();
			$types=["image/jpg","image/png","image/jpeg"];
			if($file_name=$upload->doUpload($_FILES["ID"],$types,500,10,"ids"))
			{
				$data = array("T_Name"=>$_POST["name"],"ID_Proof"=>$file_name,"Phone"=>$_POST["phone"],"Subject_Taken"=>$_POST["subject"],"T_Email"=>$_POST["email"],"Status"=>"A");
					
				if($dao->insert($data,"tr_registration"))
				{
					$data1=array("Email"=>$_POST["email"],"Password"=>md5($_POST["paswd"]),"Role_type"=>"T","Status"=>"a");
					if($dao->insert($data1,"tbl_login"))
					{
					//$msg="Success";
					}
					else
					{
					$msg="Insertion failed";
					}
				}
				else
				{
				

				}
			}
			else
				$msg_file= $upload->errors();
		}
		else
		{
			die("dfsdfsd");
		}
    }
	else
		{
			$msg="validation";
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
            <img src="assets/images/teach.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              
              <h1 class="login-card-description">Register As Teacher</h1>
              <form method = "post" enctype="multipart/form-data" >
			        <div class="form-group">
                    <label for="name" class="sr-only">Name</label>
                    <?php echo $form->textBox("name",array("placeholder"=>"Full Name")); ?>
					<?php echo $validator->error("name"); ?>
                    </div>
					
					<div class="form-group">
                    <label for="class1" class="sr-only">ID Proof </label>
					<?php echo $form->fileField("ID",array("placeholder"=>"ID Proof")); ?></td>
                    <?php echo isset($msg_file)?$msg_file:""; ?>
                    </div>
					
                    <div class="form-group mb-4">
                    <label for="password" class="sr-only">Contact Number</label>
                    <?php echo $form->textBox("phone",array("placeholder"=>"Contact Number")); ?>
					<?php echo $validator->error("phone"); ?>
                    </div>
					
					<div class="form-group mb-4">
                    <label for="password" class="sr-only">Subject Taken</label>
                    <?php echo $form->textBox("subject",array("placeholder"=>"Subject Taken")); ?>
					<?php echo $validator->error("subject"); ?>
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
				<a href="index.html" class="text-reset">HOME</a><?php echo isset($msg)?$msg:""; ?></h1>
				
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


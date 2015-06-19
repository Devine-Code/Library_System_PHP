<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet"  href="../css/bootstrap-theme.min.css">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>


<style>
	.error
	{
		color: #FF0004;
		}
</style>
<title>Registration</title>
</head>
<?php
include '../libs/database_class.php';
$usernameExistError = '';
if(isset($_POST['register']))
{
	$db = new Mysql();
	$values[0] = array("val" => $_POST["username"],"type" => "char");
	$values[1] = array("val" => $_POST["password"],"type" => "char");
	$values[2] = array("val" => $_POST["name"],"type" => "char");
	$values[3] = array("val" => $_POST["state"],"type" => "char");
	$values[4] = array("val" => $_POST["city"],"type" => "char");
	$values[5] = array("val" => $_POST["phone"],"type" => "int");
	$values[6] = array("val" => $_POST["zip"],"type" => "int");
	$values[7] = array("val" => 2, "type" => "int");
	$db->Mysql();
	$conString = $db->dbConnect();
	$query = "select count(*) from user where username ='". $_POST["username"]."' GROUP BY username;";
	$result = mysql_query($query, $db->connectionString);
	if((mysql_num_rows($result)))
	{	
		$usernameExistError = "Username already exist";	
	}
	else
	{
		$db->insertInto("user",$values);
		session_start();
		$_SESSION["username"] = $_POST["username"];
		header("Location:readerHome.php");
	}
		
	$db->dbDisconnect();
	
}
else
{
//	echo 'no';
}

?>
<body style="background-color: rgb(227, 227, 227);">
<div class="container" > 
	
	<div class="form-Wraper" style="max-width: 50%; background-color: white; margin: 6% auto; padding: 3% 0%; border-radius:5%;">
		<form id="registration" class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="off" style="max-width: 75%; margin: 0 auto;">

          <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Username </label>
                <div class="col-sm-10">
                    <input class="form-control" name="username" id="username" type="text"  placeholder="username"/>
                    <label for="username" class="error" id="username-error"></label>
                    <?php echo $usernameExistError; ?>
                </div>
          </div>
          <div class="form-group">
	            <label class="col-sm-2 control-label" for="password">Password</label>
              <div class="col-sm-10">
                <input class="form-control" name="password" id="password" type="password" placeholder="Password"/>
				<label for="password" class="error" id="password-error"></label>
			 </div>
          </div>
          
          <div class="form-group">
	            <label class="col-sm-2 control-label" for="confPass">
			 		Confirm Password
			 	</label>
              <div class="col-sm-10">
                <input class="form-control" name="confPass" id="confPass" type="password" placeholder="Confirm Password"/>
                <label for="confPass-error" class="error" id="confPass-error"></label>
			 </div>
          </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="name">
                Name
            </label>
            <div class="col-sm-10">
                <input  name="name" id="name" class="text form-control" type="text" placeholder="Name"/>
                <label for="name-error" class="error" id="name-error"></label>
			</div>
        </div>
		 <div class="form-group">
            <label class="col-sm-2 control-label" for="state">
			 	State
            </label>
            <div class="col-sm-10 pull-right">
               <input name="state" id="state" class="text form-control" type="text" placeholder="State"/>
               <label for="state-error" class="error" id="state-error"></label>
			</div>
        </div>
         <div class="form-group">
            <label class="col-sm-2 control-label" for="city">
			 		City
			</label>
            <div class="col-sm-10">
            	<input name="city" id="city" class="text form-control" type="text" placeholder="City"/>
                <label for="city-error" class="error" id="city-error"></label>
			</div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="zip">
			 		Zip
            </label>
            <div class="col-sm-10">
                <input name="zip" id="zip" class="number form-control" type="text" placeholder="Zip"/>
                <label for="zip-error" class="error" id="zip-error"></label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="phone">
			 		Phone
            </label>
            <div class="col-sm-10">
                <input name="phone" id="phone" class="number form-control" type="text" placeholder="Phone"/>
                <label for="phone-error" class="error" id="phone-error"></label>
            </div>
        </div>        
		<div class="form-group">   
        	<div class="col-sm-10 pull-right">         
             	<button id="register" name="register" class="btn btn-primary btn-block" type="submit">Register</button>
            </div>
		</div>
	</form>
	</div>
 </div>

</body>
<script type="text/javascript" src="../js/registration.js"></script>

</html>
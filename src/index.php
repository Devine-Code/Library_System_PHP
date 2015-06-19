<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet"  href="../css/bootstrap-theme.min.css">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>

<title>Library System</title>
</head>
<?php
include '../libs/database_class.php';
$loginFail = '';	
	if(isset($_POST['register']))
	{
		header("Location:registration.php");
	}
	if(isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$db = new Mysql();
		$db->Mysql();
		$conString = $db->dbConnect();
		$query = "SELECT count(*), d_id from user WHERE username = '". $username ."' AND password = '". $password ."' GROUP BY username;";

		$result = mysql_query($query,$db->connectionString);
		$num_row = mysql_num_rows($result);
		if(mysql_num_rows($result))
		{
			session_start();
			$_SESSION["username"] = $username;
			$data = mysql_fetch_array($result);
			if($data["d_id"] == 1)
				header("Location:adminHome.php");
			else
				header("Location:readerHome.php");
		}
		else
			$loginFail = "Username or Password is incorrect";		
		$db->dbDisconnect();
	}

?>
<body style="background-color: rgb(227, 227, 227);">
<div class="container" > 
	<div class="form-Wraper" style="max-width: 34%; background-color: white; margin: 11% auto; padding: 3% 0%; border-radius:5%;">
		<form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="off" style="max-width: 50%;
margin: 0 auto;">
			
			<div class="form-group">            
            	<label for="username">Username</label>
             	<input name="username" class="form-control" id="username" type="text" placeholder="Username"/>
                <label id="username-error" class="text-danger" for="username"></label>
            </div>
			<div class="form-group">
				<label for="password" >Password</label>
                <input name="password" class="form-control" id="password"  type="password" placeholder="Password"/>
                <label id="password-error" class="text-danger" for="password"></label>
            	<?php echo $loginFail; ?>
            </div>
            <div class="form-group">
            	
				<button id="login" name="login" class="btn btn-primary btn-block" type="submit">
                	<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                	&nbsp;Login
                   </button>             
    		</div>
            <div class="form-group">
            	<button id="register"  name="register" class="btn btn-primary btn-block" type="submit" >
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                	&nbsp;Register
                </button>
            </div>
		 </form>
	</div>
 </div>
</body>
<script type="text/javascript" src="../js/login.js"></script>
</html>


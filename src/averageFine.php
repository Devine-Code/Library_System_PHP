<?php	
session_start(); 
if(!isset($_SESSION["username"]))
	header("Location:index.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>

<title>Ferequent Borrowers</title>
</head>
<?php
		$link = mysqli_connect("localhost","dishant","dishant","library_system");
		$totalUserQuery = "select count(username) as noOfUsers from user where d_id = 2;";
		$totalUserResult = mysqli_query($link,$totalUserQuery);
		$totalUserArray = mysqli_fetch_array($totalUserResult);
		$totalUser = $totalUserArray["noOfUsers"];
		$totalFineQuery = "select sum(fine) as totalFine from borrow;";
		$totalFineResult = mysqli_query($link,$totalFineQuery);
		$totalFineArray = mysqli_fetch_array($totalFineResult);
		$totalFine = $totalFineArray["totalFine"];
		$averageFine = round($totalFine/$totalUser, 2);
		mysqli_close($link);
?>

<body>
<div class="container text-center">
    <h2 class='bg-info text-center'>
        Average Fine Per Reader
    </h2>
		
	<div class="panel panel-primary">
    	<div class="panel-heading">
        	<h3 class="panel-title">Fine paid by every readers</h3>
            <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>            
        </div>
        <div class="panel-body">
        	<?php echo $totalFine ?>
        </div>
    </div>
    <div class="panel panel-success">
    	<div class="panel-heading">
        	<h3 id="panel-title" class="panel-title">Total number of readers </h3>
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        </div>
        <div class="panel-body">
        	<?php echo $totalUser ?>
        </div>
    </div>
    
    <div class="panel panel-danger">
    	<div class="panel-heading">
        	<h3 id="panel-title" class="panel-title">Average fine per reader</h3>
            <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>                        
        </div>
        <div class="panel-body">
        	<?php echo $averageFine ?>
        </div>
    </div>
</div>
</body>
</html>
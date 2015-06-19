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

<style>
	.error
	{
		color: #FF0004;
	}
</style>
<title>Add Copy</title>
</head>
<?php
	include '../libs/database_class.php';
	$successMsg = 'Branch Information';
	$db = new Mysql();
	$db->Mysql();
	$conString = $db->dbConnect();
	$branchQuery = "select * from branch;";
	$bookIDResult = mysql_query($branchQuery,$db->connectionString);
?>
    <body style="">
        <div class="container" > 
            <h3 class="text-center text-danger">
                <?php echo $successMsg ?>
            </h3>
            <table class="table table-hover table-condenced">
                <?php
                    //then using while loop, it will display all the records inside the table
                    echo ' <thead> ';
                        echo ' <tr> ';
                            echo ' <th> ';
                                echo 'Branch Name';
                            echo ' </th> ';
                            echo ' <th> ';
                                echo 'Branch Location';
                            echo ' </th> ';	
                        echo ' </tr> ';		
                    echo ' </thead> ';
                    while ($row = mysql_fetch_array($bookIDResult)) {
                        echo ' <tr> ';
                            echo ' <td> ';
                                echo $row['l_name'];
                            echo ' </td> ';	
                            echo ' <td> ';
                                echo $row['city'];
                            echo ' </td> ';
                        echo ' </tr> ';	
                    }	
                ?>
            </table>	
        </div>
	</body>
</html>
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
$bookExistError = '';
$publisherNotExistError = '';
$successMsg = 'Add Copy';
$db = new Mysql();
$db->Mysql();
$conString = $db->dbConnect();
$bookIDQuery = "select * from book;";
$bookIDResult = mysql_query($bookIDQuery,$db->connectionString);
$libIDQuery = "select * from branch;";
$libIDResult = mysql_query($libIDQuery,$db->connectionString);
if(isset($_POST['addCopy']))
{
	
	$values[1] = array("val" => $_POST["bookId"],"type" => "char");
	$values[2] = array("val" => $_POST["libId"],"type" => "char");
	$values[3] = array("val" => 'n',"type" => "char");
	$values[4] = array("val" => 'n',"type" => "char");
//	$cIDQuery = "SELECT (max(c_id)) from copy WHERE book_id = '". $_POST["bookId"] ."' AND lib_id = '". $_POST["libId"] ."' group by book_id;";
	$cIDQuery = "SELECT (max(c_id)) from copy WHERE book_id = '". $_POST["bookId"] ."' group by book_id;";
	$cIDResult = mysql_query($cIDQuery, $db->connectionString);
	$cIDArray = mysql_fetch_array($cIDResult);
	$cID = ($cIDArray[0]+1);
	$values[0] = array("val" => $cIDArray[0]+1,"type" => "char");
	
	$db->insertInto("copy",$values);
	$successMsg = "Successfully Added";
	$db->dbDisconnect();
}


?>
<body style="background-color: rgb(227, 227, 227);">
<div class="container" > 
	
<h3 class="text-center text-danger">
	<?php echo $successMsg ?>
</h3>
		<div class="form-Wraper" style="max-width: 50%; background-color: white; margin: 0% auto; padding: 3% 0%; border-radius:5%;">
            <form id="registration" class="form-horizontal" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> method="post" autocomplete="off" style=" margin: 0 auto;">	 
             	<div class="form-group">
                    <label for="title" class="col-sm-4 control-label">Book Name</label>
                    <div class="col-sm-6">
                        <select  class="form-control"name="bookId" id="bookId" >
                        <?php
                            while ($row = mysql_fetch_array($bookIDResult))
                            {
                               echo '<option value="'.$row['Book_ID'].'">'.$row['title'].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                 </div>
                 
                 
                <div class="form-group">
                    <label for="libId" class="col-sm-4 control-label">Branch nName</label>
                    <div class="col-sm-6">
                        <select  class="form-control" name="libId" id="libId">
                        <?php
                            while ($row = mysql_fetch_array($libIDResult))
                            {
                               echo '<option value="'.$row[0].'">'.$row[1].'</option>';
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">   
                    <div class="col-sm-12 text-center">         
                        <button id="addCopy" name="addCopy" class="btn btn-primary" type="submit">Add Copy</button>
                    </div>
				</div>
			</form>
		</div>
 </div>

</body>

</html>
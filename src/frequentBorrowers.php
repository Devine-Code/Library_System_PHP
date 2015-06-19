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
	include '../libs/database_class.php';
	$link = mysqli_connect("localhost","dishant","dishant","library_system");
?>

<body>
<div class="container">
	<form id="search-form" name="search-form"  class="well form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <div class="form-group">
        <label for="lID" class="control-label">
            Select a Branch:
        </label>
        <div class="col-sm-10">
            <select class="dropdown-menu" role="menu" name="lID" id="lID" style="display:inline-block; position:relative;">
    	<?php
            $book = "select lib_id, l_name from branch;";
            $bookResult = mysqli_query($link, $book);
            while ($row = mysqli_fetch_array($bookResult))
            {
               echo '<option role="presentation" value="'.$row['lib_id'].'">'.$row['l_name'].'</option>';
            }
                    
            ?>
            </select>
            <button id="searchButton" name="searchButton" class="btn btn-small btn-primary" title="Get the List!" style="margin-left:0.2%;">
                <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
            </button>
          </div> 
    </div>

	      
      </form>        
</div>

<?php
	
	
	if(isset($_POST["searchButton"]))
	{
		echo "<h2 class='bg-info text-center'>";
			echo "Top 10 Borrowers Of Branch";
		echo "</h2>";
		
		if(isset($_POST["searchButton"]))	
		$groupByQuery = "select u.u_name, b.username, l.l_name, count(b.username) as noOfTimesBorrowed  from borrow b, branch l, user u where b.lib_id = '".$_POST["lID"] ."' and l.lib_id = b.lib_id and u.username = b.username group by username limit 10;";
		$headingArray = array("Name", "Username", "Branch Name", "No Of Times Borrowed");
		echo "<table class='table table-hover table-bordered'>";
			echo "<tr class='info'>";
				foreach($headingArray as $head)
				{
					echo "<th>";
						echo $head;
					echo "</th>";
				
				}
			echo "<tr>";
			$groupByResult = mysqli_query($link, $groupByQuery);
			while ($row = mysqli_fetch_array($groupByResult)) {
					createRow($row);
			}
			mysqli_free_result($groupByResult);
			mysqli_close($link);	
		echo "</table>";
}
	
function createRow($row)
{
	echo "<tr>";
		echo "<td>";
			echo $row["u_name"];
		echo "</td>";
		echo "<td>";
			echo $row["username"];
		echo "</td>";
		echo "<td>";
			echo $row["l_name"];
		echo "</td>";
		echo "<td>";
			echo $row["noOfTimesBorrowed"];
		echo "</td>";
	echo "</tr>";	
}	
?>
</body>
</html>
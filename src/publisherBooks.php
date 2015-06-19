<?php	
session_start(); 
if(!isset($_SESSION["username"]))
	header("Location:index.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">

<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet"  href="../css/bootstrap-theme.min.css" >
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>
<script src="../js/bootstrap.min.js"></script>

<style>
</style>
<title>Search Book</title>
</head>
<?php
		$link = mysqli_connect("localhost", "dishant", "dishant","library_system");
		if(isset($_POST["searchButton"]))
		{
			$searchBookQuery = '';
			$searchBookQuery .= "select b.book_id, b.title, p.p_name from book b, publisher p where (b.p_id = '". $_POST["pID"] ."') and p.p_id = '". $_POST["pID"] ."';";
		}
?>
<body>
<div class="container">
	<form id="search-form" name="search-form"  class="well form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		 <div class="container">
		 	<div class="row">
		 		<div class="">
				<?php
					$publisher = "select p_id, p_name from publisher;";
					$publisherResult = mysqli_query($link, $publisher);
                    echo '<select class="dropdown-menu" role="menu" name="pID" id="pID" style="display:block; position:relative;">'; 
                        while ($row = mysqli_fetch_array($publisherResult))
                        {
                           echo '<option role="presentation" value="'.$row['p_id'].'">'.$row['p_name'].'</option>';
                        }
                    echo '</select>';
                ?>
                	<button id="searchButton" name="searchButton" class="btn btn-small btn-primary" title="Get the List!" style="margin-left:0.2%;">
	      				<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
	     			</button>
	      		</div>
            </div>
	      </div>
      </form>        
</div>

<?php
	
	
	if(isset($_POST["searchButton"]))
	{
		$headingArray = array("Book ID", "Book Name", "Publisher Name");	
		echo "<table class='table table-hover table-bordered'>";
			echo "<tr class='info'>";
				foreach($headingArray as $head)
				{
					echo "<th>";
						echo $head;
					echo "</th>";
				
				}
			echo "<tr>";
			$i = 0;
			if (mysqli_multi_query($link, $searchBookQuery)) {
				do {
					/* store first result set */
					if ($result = mysqli_store_result($link)) {
						while ($row = mysqli_fetch_array($result)) {
								$i++;
								createRow($row, $i);
						}
						mysqli_free_result($result);
					}
					/* print divider */
					
				} while (mysqli_next_result($link));
			}
			/* close connection */
			mysqli_close($link);	
		echo "</table>";
	}
	
function createRow($row, $i)
{
	echo "<tr>";
		echo "<td>";
			echo $row[0];
		echo "</td>";
		echo "<td>";
			echo $row[1];
		echo "</td>";
		echo "<td>";
			echo $row["p_name"];
		echo "</td>";
	echo "</tr>";	
}	
?>
</body>
<script type="text/javascript" src="../js/searchBook.js"></script>
</html>
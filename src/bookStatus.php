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
<title>Book Status</title>
</head>
<?php
		$link = mysqli_connect("localhost", "dishant", "dishant","library_system");
		if(isset($_POST["searchButton"]))
		{
			$searchBookQuery = '';
			$searchBookQuery .= "select b.title, c.c_id, c.borrowed, c.reserved from book b, copy c where b.book_id = c.book_id and b.book_id = '". $_POST["bID"] ."';";
		}
?>
<body>
<div class="container">
	<form id="search-form" name="search-form"  class="well form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <div class="form-group">
        <label for="bID" class="control-label">
            Select a book:
        </label>
        <div class="col-sm-10">
            <select class="dropdown-menu" role="menu" name="bID" id="bID" style="display:inline-block; position:relative;">
    	<?php
            $book = "select book_id, title from book;";
            $bookResult = mysqli_query($link, $book);
            while ($row = mysqli_fetch_array($bookResult))
            {
               echo '<option role="presentation" value="'.$row['book_id'].'">'.$row['title'].'</option>';
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
			echo "Status of All Copies";
		echo "</h2>";
		$headingArray = array("Book Name", "Copy ID", "Status");	
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
			$result = mysqli_query($link, $searchBookQuery);
			while ($row = mysqli_fetch_array($result)) {
					$i++;
					createRow($row, $i);
			}
			mysqli_free_result($result);
			mysqli_close($link);	
		echo "</table>";
}
	
function createRow($row, $i)
{
	echo "<tr>";
		echo "<td>";
			echo $row["title"];
		echo "</td>";
		echo "<td>";
			echo $row["c_id"];
		echo "</td>";
		echo "<td>";
			if($row["borrowed"] == 'y')
				echo "Borrowed";
			else if($row["reserved"] == 'y')
				echo "Reserved";
			else
				echo "Available";
		echo "</td>";
	echo "</tr>";	
}	
?>
</body>
<script type="text/javascript" src="../js/searchBook.js"></script>
</html>
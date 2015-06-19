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
<title>Return Book</title>
</head>
<?php
	$link = mysqli_connect("localhost", "dishant", "dishant","library_system");
	if(isset($_POST["returnButton"]))
	{
		$details = explode('@',$_POST["details"]);
		$flag = 0;
		if(!($details[2] == "0"))
		{
			$updateBorrowQuery = "update borrow set fine = ". $details["2"] ." where c_id = '". $details[0] ."' And book_id = '". $details[1] ."' and date(b_date_time) like '". $details[3] ."';";
			$updateBorrowResult = mysqli_query($link, $updateBorrowQuery);
			if(! $updateBorrowResult)
				$flag = 1;
			else
				$flag = 0;
		}
		$updateCopyQuery = "update copy set borrowed = 'n' where c_id = '". $details[0] ."' And book_id = '". $details[1] ."';";
		$updateCopyResult = mysqli_query($link, $updateCopyQuery);
		if(! $updateCopyResult)
			$flag = 1;
		else 
		{
			if($flag == 0)
				$flag = 0;
		}
		if($flag == 1)	
			echo "Failure". mysql_error();
		else
			echo "<h3 class='bg-info text-center'> The book has been successfully returned</h3>";
	}

	$searchBookQuery = '';
	$searchBookMainQuery  = "SELECT book_id, c_id from borrow where username like '". $_SESSION["username"] ."' and fine=0;";
	$searchBookMainResult = mysqli_query($link, $searchBookMainQuery);
	//$searchBookBIDArray = mysqli_fetch_array($searchBookMainResult);
	//echo var_dump($searchBookBIDArray);
	$index = 0;
	while ($row = mysqli_fetch_array($searchBookMainResult))
	{
		$bIDArray[$index] = $row["book_id"];
		$index++;
		
		//$searchBookQuery .= "select b.title,l.l_name, w.c_id,w.b_date_time, w.r_date_time from book b, branch l, borrow w where (b.book_id = '". $row["book_id"] ."') and (c_id = '". $row["c_id"] ."') and (w.username like '". $_SESSION["username"] ."') and (l.lib_id = (select c.lib_id from copy c where c.c_id = '". $row["c_id"] ."' and book_id ='". $row["book_id"] ."')) ;";

		$searchBookQuery .= "select b.title,l.l_name, w.c_id,w.b_date_time, w.r_date_time from book b, branch l, borrow w where b.book_id =w.book_id and (w.book_id = '". $row["book_id"] ."') and (w.username like '". $_SESSION["username"] ."') and (l.lib_id = (select c.lib_id from copy c where c.c_id = '". $row["c_id"] ."' and book_id ='". $row["book_id"] ."')) and (w.c_id = (select c.c_id from copy c where c.c_id = '". $row["c_id"] ."' and book_id ='". $row["book_id"] ."' and borrowed = 'y')) and w.fine=0;";
	
//	$searchBookQuery .= "select b.title, w.book_id, w.b_date_time, w.c_id, w.r_date_time from borrow w, branch l,book b where b.book_id =w.book_id and (w.book_id = '". $row["book_id"] ."') and (w.username like '". $_SESSION["username"] ."') and (w.c_id = (select c.c_id from copy c where c.c_id = '". $row["c_id"] ."' and book_id ='". $row["book_id"] ."' and borrowed = 'y')) and (l.lib_id = (select c.lib_id from copy c where c.c_id = '". $row["c_id"] ."' and book_id ='". $row["book_id"] ."'));";
//echo $searchBookQuery. "------------------------------------------------------------------------------------------------------------";		
	} 
?>
<body>
<div class="container">
	<form id="return-form" name="return-form"  class="well form-inline text-center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="display:none;">
		 <div class="container">
		 	<div class="row">
		 		<div class="">
		 			<button id="returnButton" name="returnButton" class="btn btn-small btn-primary" title="Return!">
	      				Return
	     			</button>
	      		</div>
            </div>         
          <input name="details" id="details" type="hidden"/>
      </form>        
</div>

<?php
	
$headingArray = array("Name", "Branch", "Borrow Date", "Return Date", "Fine", "Return");	
echo "<h3 class='text-center'> List of Borrowed Books </h3>";
echo "<table class='table table-hover'>";
	echo "<tr class='info'>";
		foreach($headingArray as $head)
		{
			echo "<th>";
				echo $head;
			echo "</th>";
		}
	echo "<tr>";
	$idIndex = 0;
	$i = 0;
	if (mysqli_multi_query($link, $searchBookQuery)) {
		do {
			/* store first result set */
			if ($result = mysqli_store_result($link)) {
				while ($row = mysqli_fetch_array($result)) {
						$i++;
						createRow($row, $i,$bIDArray[$idIndex]);
				}
				mysqli_free_result($result);
			}
			$idIndex++;
			/* print divider */
			
		} while (mysqli_next_result($link));
	}
	/* close connection */
	mysqli_close($link);	
echo "</table>";

function createRow($row, $i, $bookID)
{
		echo "<tr>";
		echo "<td>";
			echo $row["title"];
		echo "</td>";
		echo "<td>";
			echo $row["l_name"];
		echo "</td>";
		echo "<td>";
			echo $row["b_date_time"];
		echo "</td>";
		echo "<td>";
			echo $row["r_date_time"];
		echo "</td>";
		echo "<td>";
			$fine = 0;
			date_default_timezone_set('America/New_York');
			$curruntDate = new DateTime();
			$date_expire = $row["r_date_time"];    
			$returnDate = new DateTime($date_expire);
			$difference = $curruntDate->diff($returnDate)->format("%d");
			if ($curruntDate > $returnDate)
			{
					$fine = ($difference*0.2);
					echo $fine." $";
			}
			else
				echo $fine;
		echo "</td>";
		echo "<td>";
			$value = $row["c_id"] ."@". $bookID ."@". $fine ."@". $row["b_date_time"];
			echo "<input type='radio' id='".$i."return'  name='returnRadio' value=". $value .">";
		echo "</td>";
	echo "</tr>";	
}

?>
</body>
<script type="text/javascript" src="../js/bookReturn.js"></script>
</html>
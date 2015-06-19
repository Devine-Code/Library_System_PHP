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
<title>Reserved Books</title>
</head>
<?php
	$link = mysqli_connect("localhost", "dishant", "dishant","library_system");
	date_default_timezone_set('America/New_York');
	if(isset($_POST["returnButton"]))
	{
		$details = explode('@',$_POST["details"]);
		$flag = 0;
		$curruntDate = date("Y-m-d H:i:s");
		$returnDate = date('Y-m-d H:i:s', strtotime($curruntDate. " + 20 days"));
		$insertBorrowQuery = "insert into borrow values('".$_SESSION["username"]."', '".$details[1]."', '".$details[0]."', '".$curruntDate."', '".$returnDate."', 0, '". $details[2]. "');";
		$insertBorrowResult = mysqli_query($link, $insertBorrowQuery);
		//echo $insertBorrowQuery;
		$updateCopyQuery = "update copy set borrowed = 'y', reserved = 'n' where c_id = '". $details[0] ."' And book_id = '". $details[1] ."';";	
		$updateCopyResult = mysqli_query($link, $updateCopyQuery);
		echo "<h3 class='bg-info text-center'> Book number". $details[1] . " has been successfully borrowed  and due date is ". $returnDate ."</h3>";
	}

	
	$searchBookQuery = '';
	if(date("H:i:s") < "18:00:00")
		$searchBookMainQuery  = "SELECT r.book_id, r.c_id from reserve r where  username like '". $_SESSION["username"] ." date(r.res_date_time) >= curdate() and curtime() < time('18:00:00');";
	else
		$searchBookMainQuery  = "SELECT r.book_id, r.c_id from reserve r where  username like '". $_SESSION["username"] ."' and date(r.res_date_time) > curdate();";
	$searchBookMainResult = mysqli_query($link, $searchBookMainQuery);
	//$searchBookBIDArray = mysqli_fetch_array($searchBookMainResult);
	$index = 0;
	if($searchBookMainResult)
	{
		while ($row = mysqli_fetch_array($searchBookMainResult))
		{
			$bIDArray[$index] = $row["book_id"];
			$index++;
			if(date("H:i:s") < "18:00:00")
			{
				$searchBookQuery .= "select b.title,l.l_name, w.c_id, w.res_date_time, l.lib_id from book b, branch l, reserve w where w.username = '".$_SESSION["username"]."' and b.book_id =w.book_id and l.lib_id = (select c.lib_id from copy c where c.c_id = '". $row["c_id"] ."' and book_id ='". $row["book_id"] ."') and w.c_id = '".$row["c_id"]."' and w.book_id = '". $row["book_id"] ."' and date(w.res_date_time) >= curdate() and curtime() < time('18:00:00');";
			}
			else
			{
				$searchBookQuery .= "select b.title,l.l_name, w.c_id, w.res_date_time, l.lib_id from book b, branch l, reserve w where w.username = '".$_SESSION["username"]."' and b.book_id =w.book_id and l.lib_id = (select c.lib_id from copy c where c.c_id = '". $row["c_id"] ."' and book_id ='". $row["book_id"] ."') and w.c_id = '".$row["c_id"]."' and w.book_id = '". $row["book_id"] ."' and date(w.res_date_time) > curdate();";
			}
		//	echo $searchBookQuery;
		}
	}
?>


<body>
<div class="container">
	<form id="return-form" name="return-form"  class="well form-inline text-center" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="display:none;">
		 <div class="container">
		 	<div class="row">
		 		<div class="">
		 			<button id="returnButton" name="returnButton" class="btn btn-small btn-primary" title="Return!">
	      				Borrow
	     			</button>
	      		</div>
            </div>         
          <input name="details" id="details" type="hidden"/>
      </form>        
</div>

<?php
	
$headingArray = array("Name", "Branch", "Reserve Date", "Borrow");	
echo "<h3 class='text-center'> List of Reserved Books </h3>";
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
			echo $row["res_date_time"];
		echo "</td>";
		echo "<td>";
			$value = $row["c_id"] ."@". $bookID ."@". $row["lib_id"] ."@". $row["res_date_time"];
			echo "<input type='radio' id='".$i."return'  name='returnRadio' value=". $value .">";
		echo "</td>";
	echo "</tr>";	
}

?>
</body>
<script type="text/javascript" src="../js/bookReturn.js"></script>
</html>
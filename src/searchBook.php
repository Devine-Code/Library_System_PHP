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
	include '../libs/database_class.php';
	date_default_timezone_set('America/New_York');
	$db = new Mysql();
	$db->Mysql();
	$conString = $db->dbConnect();
	$Msg = '';
	if(isset($_POST['searchButton']))
	{
		$searchBookQuery = '';
		$bookIDQuery = '';
		$selection = $_POST["optradio"];
		if($selection=="Book_ID" || $selection=="title")
		{
			$bookID = '';
			if($selection == "title")
			{
				$bookIDQuery = "SELECT book_id from book WHERE title like '". $_POST["searchInput"] ."';";
				$bookIDResult = mysql_query($bookIDQuery, $db->connectionString);
				$bookIDArray = mysql_fetch_array($bookIDResult);
				$bookID = $bookIDArray[0];
			}
			else
				$bookID = $_POST["searchInput"];
				
			$searchBookQuery = "select b.title, b.author, p.p_name, l.l_name, c.c_id, c.borrowed, c.reserved, l.lib_id from book b, publisher p, branch l, copy c where (b.book_id = '". $bookID ."') and (p.p_id = b.p_id) and (c.book_id = '". $bookID ."') and (l.lib_id = c.lib_id);";
			
			$searchBookResult = mysql_query($searchBookQuery, $db->connectionString);
		}
		else
		{
			
			$link = mysqli_connect("localhost", "dishant", "dishant","library_system");
			$searchBookQuery = '';
			$searchBookMainQuery  = "SELECT book_id from book where p_id = (select p_id from publisher where p_name like '". $_POST["searchInput"] ."');";
			$searchBookMainResult = mysqli_query($link, $searchBookMainQuery);
		//		$searchBookBIDArray = mysqli_fetch_array($searchBookMainResult);
			//echo var_dump($searchBookBIDArray);
			$index = 0;
			while ($row = mysqli_fetch_array($searchBookMainResult))
			{
				$bIDArray[$index] = $row["book_id"];
				$index++;
				$searchBookQuery .= "select b.title, b.author, p.p_name,l.l_name, c.c_id, c.borrowed, c.reserved, l.lib_id from book b, publisher p, branch l, copy c where (b.book_id = '". $row["book_id"] ."') and (p.p_id = b.p_id) and (c.book_id = '". $row["book_id"] ."') and (l.lib_id = c.lib_id);";	
			} 
			/* execute multi query */
		}
	}
	if(isset($_POST["BRButton"]))
	{
		$BRSelection = $_POST["BRradio"];
		$selectedIDs = $_POST["copyAndBookID"];
		//$reserveRadio = $_POST["reserveRadio"];
		$selectedIDArray = explode('-', $selectedIDs); 
		$selectedCopyID = $selectedIDArray[1]; 
		$selectedBookID = $selectedIDArray[2];
		date_default_timezone_set('America/New_York');
		$curruntDate = date("Y-m-d H:i:s");
		$returnDate = date('Y-m-d H:i:s', strtotime($curruntDate. " + 20 days"));
		$values[0] = array("val" => $_SESSION["username"],"type" => "char");
		$values[1] = array("val" => $selectedBookID,"type" => "char");
		$values[2] = array("val" => $selectedCopyID,"type" => "char");
		

		if($_POST["BRradio"] == 'borrow')
		{
			$libraryID = $selectedIDArray[3];	
			$values[3] = array("val" => $curruntDate,"type" => "char");
			$values[4] = array("val" => $returnDate,"type" => "char");
			$values[5] = array("val" => 0,"type" => "int");
			$values[6] = array("val" => $libraryID,"type" => "char");
			$insertQuery = "insert into borrow values ('". $_SESSION["username"] ."', '". $selectedBookID ."','". $selectedCopyID . "', '". $curruntDate. "', '". $returnDate ."',0,'" . $libraryID ."');";
			mysql_query($insertQuery,$db->connectionString);
			$updateQuery = "update copy set borrowed = 'y' where c_id = ". $selectedCopyID ." AND book_id = ". $selectedBookID .";";
			$Msg ="You have borrowed book number ". $selectedBookID. " and due Date is ".$returnDate;
		}
		else
		{
			if(date("H:i:s") > "18:00:00")
			{
				$values[3] = array("val" => date('Y-m-d 00:00:00', strtotime($curruntDate. " + 1 days")),"type" => "char");	
				//$values[3] = array("val" => date('Y-m-d H:i:s', strtotime($curruntDate. " + 1 days")),"type" => "char");	
			}
			else
				$values[3] = array("val" => $curruntDate,"type" => "char");	
			$values[4] = array("val" => 'y',"type" => "char");
			$updateQuery = "update copy set reserved = 'y' where c_id = ". $selectedCopyID ." AND book_id = ". $selectedBookID .";";
			$Msg = "You have reserved book number ". $selectedBookID;
			$db->insertInto($_POST["BRradio"], $values);
		}
		$updateResult = mysql_query($updateQuery, $db->connectionString);
		if(! $updateResult)
			$Msg = "Failure". mysql_error();
 
	}

?>
<body>
<div class="container">
	<form id="search-form" name="search-form"  class="well form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		 <div class="container">
		 	<div class="row">
		 		<div class="">
		 			<input id="searchInput" name="searchInput" class="form-control number" placeholder="Book Id OR Book Title OR Publihser Name" data-provide="typeahead" type="text" style="width:50%">
	       			<button id="searchButton" name="searchButton" class="btn btn-small btn-primary" title="Go forth and search!">
	      				<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
	     			</button>
	      		</div>
            </div>    
            <div class="row">    
                <div class="radiobutton">
		 			<label class="radio-inline ">
                      <input type="radio"  name="optradio" value="Book_ID" checked="checked">Book ID
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="optradio" value="title">Book Title
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="optradio" value="p_name">Publisher Name
                    </label>
	      		</div>
	      	</div>
            <div id="jumbo" class="jumbotron pull-right"  style="display:none; max-width: 30%; margin: -5% 5% 0% 0%; padding: 1%; border: 1px solid #CECECE;">
		 			<label class="radio-inline ">
                      <input type="radio"  name="BRradio" value="borrow" checked="checked">Borrow
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="BRradio" value="reserve">Reserve
                    </label>
                    <button id="BRButton" name="BRButton" class="btn btn-small btn-info" title="Go forth Borrow or Reserve!">
	      				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
	     			</button>
            </div>
	      </div>
          <input name="copyAndBookID" id="copyAndBookID" type="hidden"/>
      </form>        
</div>




<?php
	
	echo "<h3 class='text-center bg-info'>"; 
		echo $Msg;
	echo "</h3>";
	if(isset($_POST["searchButton"]))
	{
		$headingArray = array("Name", "Author", "Publisher Name", "Branch","Copy ID","Borrow","Reserve");	
		echo "<table class='table table-hover'>";
			echo "<tr class='info'>";
				foreach($headingArray as $head)
				{
					echo "<th>";
						echo $head;
					echo "</th>";
				
				}
			echo "<tr>";
			$i = 0;
			if($selection != "p_name")
			{
				
				while($row = mysql_fetch_array($searchBookResult))
				{
					$i++;
					createRow($row,$i, $bookID); 
				}
				$db->dbDisconnect();	
			}
			else
			{
				$idIndex = 0;
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
			}
		echo "</table>";
	}
	
function createRow($row, $i, $bookID)
{
		$functionLink = mysqli_connect("localhost","dishant","dishant","library_system");
		if(date("H:i:s") < "18:00:00")
		{
			$checkQuery = "select count(*) from reserve where c_id =".  $row["c_id"] ." and book_id = ". $bookID ." and date(res_date_time) >= curdate() and curtime() <= '18:00:00';";
		}
		else
		{
			$checkQuery = "select count(*) from reserve where c_id =".  $row["c_id"] ." and book_id = ". $bookID ." and date(res_date_time) > curdate()";
		}
		$checkResult = mysqli_query($functionLink,$checkQuery);
		$checkArray = mysqli_fetch_array($checkResult);
		
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
		echo "<td>";
			echo $row["l_name"];
		echo "</td>";
		echo "<td>";
			echo $row["c_id"];
		echo "</td>";
		echo "<td>";
			if($row["borrowed"] == "n" && $checkArray[0] == 0)
				echo "<input type='radio' id=".$i."Borrow  name='borrowRadio' value=b-". $row["c_id"] ."-". $bookID."-".$row["lib_id"] .">";
			else
				echo "NA";
		echo "</td>";
		echo "<td>";
			if($checkArray[0] == 0 && $row["borrowed"] == "n" )
				echo "<input type='radio' id=".$i."Reserve  name='reserveRadio' disabled='disabled'  value=r-". $row["c_id"] ."-". $bookID.">";
			else
				echo "NA";
		echo "</td>";
	echo "</tr>";	
}	
?>
</body>
<script type="text/javascript" src="../js/searchBook.js"></script>
</html>
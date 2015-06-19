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

<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet"  href="../css/bootstrap-theme.min.css">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>

<style>
	.error
	{
		color: #FF0004;
	}
</style>
<title>Add New Book</title>
</head>
<?php
include '../libs/database_class.php';
$db = new Mysql();
$db->Mysql();
$conString = $db->dbConnect();
$successMsg = "Add a Book";
if(isset($_POST['addBook']))
{
	$values[0] = array("val" => $_POST["bookId"],"type" => "char");
	$values[1] = array("val" => $_POST["title"],"type" => "char");
	$values[2] = array("val" => $_POST["author"],"type" => "char");
	$values[3] = array("val" => $_POST["isbn"],"type" => "char");
	$date = $_POST["year"].'-'.$_POST["month"].'-'.$_POST["pDate"];
	$values[4] = array("val" => $date,"type" => "char");
	$values[5] = array("val" => $_POST["pId"],"type" => "char");
	$db->insertInto("book",$values);
	$successMsg =  $_POST["title"] ." has been successfully added";
	//header("Location:readerHome.php");
}

$query = "select count(book_id) as lastID from book;";
$result = mysql_query($query,$db->connectionString);
$bookIDArray =  mysql_fetch_array($result);
$newBookID = $bookIDArray["lastID"]+1;
?>
<body style="background-color: rgb(227, 227, 227);">
<div class="container" > 
	
        <h3 class="text-center text-danger">
            <?php echo $successMsg ?>
        </h3>
		<div class="form-Wraper" style="max-width: 50%; background-color: white; margin: 0% auto; padding: 3% 0%; border-radius:5%;">
            <form id="registration" class="form-horizontal" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?> method="post" autocomplete="off" style=" margin: 0 auto;">
                 
                <div class="form-group">
                    <label for="bookID" class="col-sm-4 control-label">Book ID </label>
                    <div class="col-sm-6">
                        <input name="bookId" id="bookId" type="text" class="form-control" readonly value=<?php echo $newBookID ?> />
                        <label for="bookId" class="error" id="bookId-error"></label>
                    </div>
                </div>	
                
                <div class="form-group">
                    <label for="title" class="col-sm-4 control-label">Title </label>
                    <div class="col-sm-6">
                        <input name="title" id="title" type="text" class="form-control text" placeholder="Book Title"/>
                        <label for="title" class="error" id="title-error"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="author" class="col-sm-4 control-label">Author </label>
                    <div class="col-sm-6">
                        <input name="author" id="author" type="text" class="form-control text" placeholder="Author Name"/>
                        <label for="author-error" class="error" id="author-error"></label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="isbn" class="col-sm-4 control-label">ISBN </label>
                    <div class="col-sm-6">
                        <input name="isbn" id="isbn" class="form-control number" type="text" placeholder="ISBN Number"/>
                        <label for="isbn-error" class="error" id="isbn-error"></label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="pDate" class="col-sm-4 control-label">Publication Date </label>
                    <div class="col-sm-6">
					<select name="year" id="year"  class="form-control" style="display: inline-block; width: 30%;">
						<?php
                                for($i = 2015; $i>0; $i--)
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                        ?>
                    </select>
                    <select name="month" id="month"  class="form-control"  style="display: inline-block; width: 25%;"> 
						<?php
                                for($i = 1; $i<13; $i++)
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                        ?>
                    </select>
					<select name="pDate" id="pDate" type="text"  class="form-control " style="display: inline-block; width: 25%;"/>
						<?php
                                for($i = 1; $i<32; $i++)
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                        ?>
                    </select>
					<label for="pDate-error" class="error" id="pDate-error"></label>
                    </div>
                    
                </div>
                <div class="form-group">
                    <label for="pId" class="col-sm-4 control-label">Publisher ID </label>
                    <div class="col-sm-6">
						<select name="pId" id="pId" class="form-control number" type="text" placeholder="Publoisher ID">
						<?php
							$publicationQuery = "select p_id, p_name from publisher;";
							$publicationResult = mysql_query($publicationQuery);
                        	while ($row = mysql_fetch_array($publicationResult))
							{
							   echo '<option value="'.$row['p_id'].'">'.$row['p_name'].'</option>';
							}
						?>
                        </select>
		                <label for="pId-error" class="error" id="pId-error"></label>
                    </div>
                </div>
                <div class="form-group">   
                    <div class="col-sm-12 text-center">         
                        <button id="addBook" name="addBook" class="btn btn-primary" type="submit">Add Book</button>
                    </div>
                </div>
             </form>
		</div>		
 </div>

</body>
<script type="text/javascript" src="../js/addBook.js"></script>

</html>
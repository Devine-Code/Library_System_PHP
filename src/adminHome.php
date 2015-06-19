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
<script type="text/javascript" src="../js/bootstrap.min.js"></script>


<title>
<?php 
	echo 'Welcome '.$_SESSION["username"]; 
?>
</title>
</head>
<body>

<h4 class="text-center bg-primary">
<?php 
	echo 'Welcome '.$_SESSION["username"]; 
?>	
</h4>

<ul class="nav nav-tabs">
    <li class="" role="presentation">
        <a aria-expanded="false" href="#addBookDiv" role="tab" id="addBookTab" refId="addBook" data-toggle="tab" aria-controls="addBook-tab">
            Add Book
        </a>
    </li>
    <li class="" role="presentation">
        <a aria-expanded="false" href="#addCopyDiv" role="tab" id="addCopyTab" refId="addCopy" data-toggle="tab" aria-controls="addCopy-tab">
            Add Copy
        </a>
    </li>
    <li class="" role="presentation">
        <a aria-expanded="false" href="#showBranchDiv" role="tab" id="showBranchTab" refId="showBranch" data-toggle="tab" aria-controls="showBranch-tab">
            Branches
        </a>
    </li>
    <li class="" role="presentation">
        <a aria-expanded="false" href="#bookStatusDiv" role="tab" id="bookStatusTab" refId="bookStatus"  data-toggle="tab" aria-controls="bookStatus-tab">
            Book Status
        </a>
    </li>
    <li class="" role="presentation">
        <a aria-expanded="false" href="#frequentBorrowersDiv" role="tab" id="frequentBorrowersTab" refId="frequentBorrowers" data-toggle="tab"  aria-controls="frequentBorrowers-tab">
            Frequent Borrowers
        </a>
    </li>
    <li class="" role="presentation">
        <a aria-expanded="false" href="#mostBorrowedDiv" role="tab" id="mostBorrowedTab" refId="mostBorrowed" data-toggle="tab" aria-controls="mostBorrowed-tab">
            Most Borrowed Books
        </a>
    </li>
    
    <li class="" role="presentation">
        <a aria-expanded="false" href="#averageFineDiv" role="tab" id="averageFineTab" refId="averageFine" data-toggle="tab" aria-controls="averageFine-tab">
            Average Fine
        </a>
    </li>
    
    <li class="" role="presentation">
        <a aria-expanded="false" href="logOut.php">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            Log Out
        </a>
    </li>
</ul>


<div class="tab-content" style="">
    <div role="tabpanel" class="tab-pane fade embed-responsive embed-responsive-16by9" id="addBookDiv" aria-labelledby="addBook-tab">
		<iframe id="addBook" class="embed-responsive-item" src="addBook.php">
        </iframe>		
	</div>
    <div role="tabpanel" class="tab-pane fade embed-responsive embed-responsive-16by9" id="addCopyDiv" aria-labelledby="addCopy-tab">
		<iframe id="addCopy" class="embed-responsive-item" src="addCopy.php" >
        </iframe>
	</div>
    <div role="tabpanel" class="tab-pane fade embed-responsive embed-responsive-16by9" id="showBranchDiv" aria-labelledby="showBranch-tab">
		<iframe id="showBranch" class="embed-responsive-item" src="showBranch.php" class="content">
        </iframe>
	</div>
    <div role="tabpanel" class="tab-pane fade embed-responsive embed-responsive-16by9" id="frequentBorrowersDiv" aria-labelledby="frequentBorrowers-tab">
		<iframe id="frequentBorrowers" class="embed-responsive-item" src="frequentBorrowers.php" >
        </iframe>
	</div>
    <div role="tabpanel" class="tab-pane fade embed-responsive embed-responsive-16by9" id="mostBorrowedDiv" aria-labelledby="mostBorrowed-tab">
		<iframe id="mostBorrowed" class="embed-responsive-item" src="mostBorrowed.php" >
        </iframe>
	</div>
    <div role="tabpanel" class="tab-pane fade embed-responsive embed-responsive-16by9" id="bookStatusDiv" aria-labelledby="bookStatus-tab">
		<iframe id="bookStatus" class="embed-responsive-item" src="bookStatus.php" >
        </iframe>
	</div>
    <div role="tabpanel" class="tab-pane fade embed-responsive embed-responsive-16by9" id="averageFineDiv" aria-labelledby="averageFine-tab">
		<iframe id="averageFine" class="embed-responsive-item" src="averageFine.php">
        </iframe>
	</div>
</div>
</body>
<script>
$('#myTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
});

$('a').click(function(e)
{
	var frameId = ($(this).attr("refId"));
	$('#'+frameId).attr('src', $('#'+frameId).attr('src'));
});
</script>
</html>
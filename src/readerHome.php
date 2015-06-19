<?php	
session_start(); 
if(!isset($_SESSION["username"]))
	header("Location:index.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
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
        <a aria-expanded="false" href="#searchDiv" role="tab" id="searchTab" refId="searchBook" data-toggle="tab" aria-controls="search-tab">
            Search/Borrow/Reserve
	    </a>
    </li>
    <li class="" role="presentation">
        <a aria-expanded="false" href="#returnDiv" role="tab" id="returnTab" refId="bookReturn" data-toggle="tab" aria-controls="return-tab">
            Return Books
        </a>
    </li>
    <li class="" role="presentation">
        <a aria-expanded="false" href="#reservedDiv" role="tab" id="reservedTab" refId="reservedBooks" data-toggle="tab" aria-controls="reserved-tab">
            Reserved Books
        </a>
    </li>
	
    <li class="" role="presentation">
        <a aria-expanded="false" href="#pubInfoDiv" role="tab" id="pubInfoTab" refId="publisherBooks" data-toggle="tab" aria-controls="pubInfo-tab">
            Publisher's Books
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
    <div role="tabpanel" class="tab-pane fade embed-responsive embed-responsive-16by9" id="searchDiv" aria-labelledby="search-tab">
		<iframe id="searchBook" class="embed-responsive-item" src="searchBook.php" >
        </iframe>		
	</div>
    <div role="tabpanel" class="tab-pane fade embed-responsive embed-responsive-16by9" id="returnDiv" aria-labelledby="return-tab">
		<iframe id="bookReturn" class="embed-responsive-item" src="bookReturn.php" >
        </iframe>
	</div>
    <div role="tabpanel" class="tab-pane fade embed-responsive embed-responsive-16by9" id="reservedDiv" aria-labelledby="reserved-tab">
		<iframe id="reservedBooks" class="embed-responsive-item" src="reservedBooks.php">
        </iframe>
	</div>
    <div role="tabpanel" class="tab-pane fade embed-responsive embed-responsive-16by9" id="pubInfoDiv" aria-labelledby="pubInfo-tab">
		<iframe id="publisherBooks" class="embed-responsive-item" src="publisherBooks.php">
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
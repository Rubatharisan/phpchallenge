<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Made by Rubatharisan Thirumathyam
/* The current challenge is: (PHP)
		The goal of the PHP challenge is to create a simple but flexible template parser.
		- It must automatically translate an HTML template with placeholders into a HTML string with placeholders replaced by the corresponding values.
		- It must be possible to supply an object or array with key-value pairs, where key indicates the placeholder that must be replaced by the value.
	NOTE: This code uses Twitter Bootstrap only for styling - if this is not allowed, please let me redo this work.
	NOTE: This code is not made in a object-oriented manner - if this is not allowed, please let me redo this work.
*/
		include('page.class.php');
		$page = new page();
		
		// Setting standard page title, header and text
		$pageTitle 	= 	"PHP Challenge";
		$pageHeader = 	"My PHP Challenge";
		$pageText 	= 	"- It must automatically translate an HTML template with placeholders into a HTML string with placeholders replaced by the corresponding values.<br>
		- It must be possible to supply an object or array with key-value pairs, where key indicates the placeholder that must be replaced by the value. <br> <b>NOTE: This code uses Twitter Bootstrap only for styling - if this is not allowed, please let me redo this work. <br>
	NOTE: This code is not made in a object-oriented manner - if this is not allowed, please let me redo this work.</b>";

		// If GET request is set, use values from this.
			if(isset($_GET['pageTitle']) && !$_GET['pageTitle'] == null){
				$pageTitle 	= 	$_GET['pageTitle'];
			}

			if(isset($_GET['pageHeader']) && !$_GET['pageHeader'] == null){
				$pageHeader =	$_GET['pageHeader'];
			}

			if(isset($_GET['pageText']) && !$_GET['pageText'] == null){
				$pageText	=	$_GET['pageText'];
			}

		// If POST request is set, use values from this.
			if(isset($_POST['pageTitle']) && !$_POST['pageTitle'] == null && $_POST['dataType'] == "post"){
				$pageTitle 	= 	$_POST['pageTitle'];
			}

			if(isset($_POST['pageHeader']) && !$_POST['pageHeader'] == null && $_POST['dataType'] == "post"){
				$pageHeader =	$_POST['pageHeader'];
			}

			if(isset($_POST['pageText']) && !$_POST['pageText'] == null && $_POST['dataType'] == "post"){
				$pageText	=	$_POST['pageText'];
			}

		// if JSON object is set, use values from object. (object gottten from POST & GET)
			//Encoding object!
			if(isset($_POST['dataType']) && $_POST['dataType'] == "json"){
				$pageArray 	=	array('pageTitle' => $_POST['pageTitle'], 'pageHeader' => $_POST['pageHeader'], 'pageText' => $_POST['pageText']);
				$pageJsoned = json_encode($pageArray);
			}

			// example json object: ?json={"pageTitle":"Testing","pageHeader":"testing","pageText":"testing"}
			if(isset($_GET['json'])){
				$pageJsoned = $_GET['json'];
			}

			// Setting the placeholders to values of the object.
			if(isset($pageJsoned) && !$pageJsoned == null){
				$pageObject =	json_decode($pageJsoned);
				$pageTitle 	=	$pageObject->pageTitle;
				$pageHeader	= 	$pageObject->pageHeader;
				$pageText 	=	$pageObject->pageText;
			}

		// Remove tags (prevent XSS)
			$pageTitle = strip_tags($pageTitle);
			$pageHeader = strip_tags($pageHeader);
			$pageText = strip_tags($pageText, "<br><b>"); // allow linebreak and bold (should be strong)

?>
<!-- Defining doctype -->
<!DOCTYPE html>
<!-- HTML start tag -->
<html lang="">
<!-- head start tag -->
	<head>
	<!-- meta charset tag -->
		<meta charset="utf-8">
		<!-- meta defining which version of IE this HTML document should support --> 
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- meta defining viewpoint and which scalling -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- setting title of page -->
		<title><?php echo $pageTitle; ?></title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- closing head tag -->
	</head>
	<!-- starting body tag -->
	<body>
	<br>
		<div class="col-md-12">
			<div class="col-md-4">
			<!-- Making the form -->
			<form action="/p/" method="POST" class="form-inline" role="form">
				<div class="form-group">
					<label class="sr-only" for="">Page Title</label>
					<input name="pageTitle" type="text" class="form-control" id="" placeholder="Page title">
				</div>
				<div class="form-group">
					<label class="sr-only" for="">Page Header</label>
					<input name="pageHeader" type="text" class="form-control" id="" placeholder="Page header">
				</div>
				<br><br>
				<div class="form-group">
					<label class="sr-only" for="">Page Text</label>
					<textarea name="pageText" cols="54" type="text" class="form-control" id="" placeholder="Page text"></textarea>
				</div>
				<hr>
				<div class="form-group">
					<label for="input" class="col-sm-2 control-label">Use: </label>
					<div class="col-sm-2">
						<select name="dataType" id="input" class="form-control" required="required">
							<option selected="selected" value="post">POST</option>
							<option value="json">JSON</option>
						</select>
					</div>
				</div>
				<hr>
				<center><button type="submit" class="btn btn-primary">Submit</button></center>
				<br>
			</form>
			</div>
			<div class="col-md-8">
			<center>
				<h1> <?php echo $pageHeader; ?> </h1>
				<hr>
				<p><?php echo $pageText; ?></p>
			</center>
			<hr>
			</div>
		</div>
		<div class="col-md-12 jumbotron">
			<div class="col-md-6">
			<strong>Info</strong>
			<br>
			<i>To use $_GET to set page title, header and text, please click here: <code><a href="http://sejlet.dk/p/?pageTitle=newTitle&pageHeader=newHeader&pageText=newPageText">/?pageTitle=newTitle&pageHeader=newHeader&pageText=newPageText</a></code></i>
			<br>
			<i>To use JSON (remotely by a GET request) to set page title, header and text, please click here: <code><a href='http://sejlet.dk/p/?json={"pageTitle":"Testing","pageHeader":"testing","pageText":"testing"}'>/?json={"pageTitle":"Testing","pageHeader":"testing","pageText":"testing"}</a></code></i>

			</div>

			<div class="col-md-6">
			<strong>Debugging info (NOT PROTECTED!)</strong>
			<br>
			<?php
			// Debugging info for $_GET
				if(isset($_GET) && !$_GET == null){
					echo "Vardump of <strong>GET</strong>:";
					echo "<br>";
					var_dump($_GET);
					echo "<br>";
					echo "Print_r of <strong>GET</strong>";
					echo "<br>";
					print_r($_GET);
				}
			// Debugging info for $_POST
				if(isset($_POST) && !$_POST == null && $_POST['dataType'] == "post"){
					echo "Vardump of <strong>POST</strong>:";
					echo "<br>";
					var_dump($_POST);
					echo "<br>";
					echo "Print_r of <strong>POST</strong>";
					echo "<br>";
					print_r($_POST);
				}
			// Debugging info for JSON object
				if(isset($_POST) && !$_POST == null && $_POST['dataType'] == "json"){
					echo "Vardump of <strong>JSON object</strong>:";
					echo "<br>";
					var_dump($pageJsoned);
					echo "<br>";
					echo "Print_r of <strong>JSON object</strong>";
					echo "<br>";
					print_r($pageJsoned);
				}
			?>
			</div>
		</div>
	<center><small>Made by Rubatharisan Thirumathyam</small></center>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
		<!-- closing body tag -->
	</body>
	<!-- closing html tag -->
</html>
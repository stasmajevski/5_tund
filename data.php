<?php

// me peame uhendama lehed, et session tootaks

	require("functions.php");
	// kui ei ole kasutajat id'd
	if(!isset($_SESSION["userID"]))
	{
		//suunan sisselogimise lehele
		header("Location: login.php");
	}
	
	//kui on ?logout aadressireal siis login valja
	if(isset($_GET["logout"]))
	{
		session_destroy();
		header("Location: login.php");
	}
	$msg="";
	if(isset($_SESSION["message"]))
	{
		$msg = $_SESSION["message"];	

			// kui uhe naitame siis kustuta ara, et parast refreshi ei naitaks
			unset($_SESSION["message"]);
	}
	
	
	if(isset($_POST["carPlate"]) && isset($_POST["carColor"]) && !empty($_POST["carPlate"]) && !empty($_POST["carColor"]))
	{
		saveCar($_POST["carPlate"],$_POST["carColor"]);
	}
	
?>
<link rel="stylesheet" type="text/css" href="style.css">
<!-- lisasin 'Nunito' fonti -->
 <link href='http://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>

<?=$msg;?>
<p>Tere tulemast <?=$_SESSION["userEmail"];?>!</p>
<a href="?logout=1">Logi välja</a>


<form method="POST">
	<h1>Salvesta autot</h1>
	
    <label for="carPlate">Cars number: </label>
	<input name="carPlate" type="text" value=""><br><br>
    <label for="carColor">Cars color: </label>
	<input name="carColor" type="color"><br><br>
	
	<input type="submit" value="Save car" class="button">
</form>


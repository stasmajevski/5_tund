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
	
	$carData = getAllCars();
	//echo "<pre>";
	//var_dump($carData);
	//echo "</pre>";
	
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

<h1>Autod</h1>

<?php
// th - table header
// td - table data
// tr - table row

	$html = "<table style='border:1px solid;margin:0 auto;'>";

	$html .="<tr>";
		$html .="<th>id</th>";
		$html .="<th>plate</th>";
		$html .="<th>color</th>";
	$html .="</tr>";
	
	
	
	// iga liikme kohta masiivis
	foreach($carData as $item)
	{
		// iga auto on $c
	$html .="<tr>";
		$html .="<td style='border:1px solid;'>".$item->id."</td>";
		$html .="<td style='border:1px solid;'>".$item->plate."</td>";
		$html .="<td style='border:1px solid; padding:10px;background-color:".$item->carColor."'>".$item->carColor."</td>";
	$html .="</tr>";
		
	}

	$html .="</table>";
	echo $html;
	
	$listHtml = "<br><br>";
	
	foreach($carData as $item)
	{
		// iga auto on $item
		
		$listHtml .= "<h1 style='color:".$item->carColor."'>".$item->plate."</h1>";
		$listHtml .= "<h1>color = ".$item->carColor."</h1>";
			
	}
	
	echo $listHtml;
?>

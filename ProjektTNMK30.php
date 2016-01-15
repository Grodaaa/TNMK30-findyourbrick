<?php print("<?xml version = '1.0' encoding = 'iso-8859-1'?>\n"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
<!--Projekt i Elektroniskpublicering (TNMK30)-->
<!--Grupp 6 - Stina Grenholm, Kristina Engström, Therese Ramböl, Ellen Häger--> 
<head>
<?php
// För att komma åt databasen
mysql_connect("mysql.itn.liu.se","lego");
mysql_select_db("lego");
// Från formuläret, om man trycker på "submit"-knappen, kommer
// variablen $POST["setnr"] som innehåller texten i fältet(rutan) "setnr".
$setnr = $_GET["setnr"];
$search = $_GET["search"];
?>
<title>Lego-bit nummer <?php print $search; ?></title>
<link rel="stylesheet" type="text/css" href="ProjektTNMK30.css" />
</head>
<body>
<div class="style4">
<p>
	<a href="ProjektTNMK30.html">Startsida</a>
</p>
<h2>Funna bitar:</h2>
<p>
<?php
	$page = $_GET["page"];
	if ($page == ""){
	$page = 1;
	}	
	$startnr =(($page-1)*10);
	$searchall = explode(" ", $search);
	$sokstrang = "SELECT * FROM parts WHERE PartID LIKE '%$setnr%'";
	foreach ($searchall as $value) {
		$sokstrang .= " AND Partname LIKE '%$value%'";
		}
		$sokstrang .= " LIMIT $startnr, 10";
	
	
	$contents = mysql_query($sokstrang);	
	
	if(mysql_num_rows($contents) == 0){
	echo "Kontrollera artikelnummer! ";
	} else {
		//Skriver ut tabellen.
		echo "<table id=\"style\" border=0>\n<tr>";
		echo "<th>Part Image</th>";
		echo "<th>PartID</th>";
		echo "<th>Partname</th>";
		
		
		
		echo "</tr>\n";
		while($row = mysql_fetch_assoc($contents)) 
		{
			
			echo "<tr>";
				//Bilder länkas med hjälp av ColorID.
				$contentsColorID = mysql_query("SELECT ColorID FROM inventory WHERE ItemID = '$row[PartID]'");
				$rowColor = mysql_fetch_assoc($contentsColorID);
				echo "<td><img src=\"http://img.bricklink.com/P/". $rowColor['ColorID'] ."/" . $row[PartID] . ".gif\"/>";
				echo "<img src=\"http://img.bricklink.com/P/". $rowColor['ColorID'] ."/" . $row[PartID] . ".jpg\"/></td>";
				echo "<td><a href='http://www.student.itn.liu.se/~ellha959/Projekt/printsetsbypart.php?itemid=".$row[PartID]."'>$row[PartID]</a></td>";
				echo "<td>$row[Partname]</td>";

			echo "</tr>\n";
		}
			echo "</table>\n";
	}
?>
</p>
<p>

<!--Delar upp tabellen i olika sidor så att man slipper scrolla i evigheter som det är många träffar.--> 
<?php
	$contents = mysql_query("SELECT COUNT(*) AS totalnumber FROM parts WHERE PartID LIKE '%$setnr%' AND Partname LIKE '%$search%'");
	$row = mysql_fetch_assoc($contents);
	$maxpage = (ceil($row[totalnumber]/10));
	if($page > 1) {
		$prevpage = ($page-1);
		echo "<a href='ProjektTNMK30.php?page=".$prevpage."&setnr=".$setnr."&search=".$search."'>Previous</a> ";
	 }
	if($page < $maxpage) {
		$nextpage = ($page+1);
		echo "<a href='ProjektTNMK30.php?page=".$nextpage."&setnr=".$setnr."&search=".$search."'>Next</a> ";
	}
?> 

</p>
<!--Startsida--> 
<p>
	<a href="ProjektTNMK30.html">Startsida</a>
</p>	
</div>
</body>
</html>

<?php print("<?xml version = '1.0' encoding = 'iso-8859-1'?>\n"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html>
<!--Projekt i Elektroniskpublicering (TNMK30)-->
<!--Grupp 6 - Stina Grenholm, Kristina Engström, Therese Ramböl, Ellen Häger--> 
<head>
<?php

?>
<link rel="stylesheet" type="text/css" href="ProjektTNMK30.css" />
</head>


<body>
<div class="style4">
<!--Länk tillbaka till startsidan--> 
<p>
	<a href="ProjektTNMK30.html">Startsida</a>
</p>
<p>
	<a href="javascript:history.go(-1)">Tillbaka</a>
</p>

<p>

<h2>Den här biten finns i dessa satser:</h2>
<p>
<?php
mysql_connect("mysql.itn.liu.se","lego");
mysql_select_db("lego");
$itemid = $_GET["itemid"];
	$contents = mysql_query("SELECT inventory.ItemID, sets.SetID, sets.Setname 
  FROM inventory
  JOIN sets ON inventory.SetID = sets.SetID
  
  WHERE inventory.ItemID LIKE '$itemid%'
  ORDER BY ItemID, Setname");
if(mysql_num_rows($contents) == 0) {
	print("Kontrollera artikelnummer! ");
	} else {
	//Skriver ut tabellen.
	print("<table id=\"style\" border=0>\n<tr>");
	echo "<th>Part Image</th>";
	echo "<th>ItemID</th>";
	echo "<th>SetID</th>";
	echo "<th>Setname</th>";
	
	
	print "</tr>\n";
	while($row = mysql_fetch_assoc($contents)) 
	{
		print("<tr>");

			//Hämtar setbilder.
			echo("<td><img src=\"http://img.bricklink.com/S/" . $row[SetID] . ".gif\"/></td>");
			echo "<td>$row[ItemID]</td>";
			echo "<td>$row[SetID]</td>";
			echo "<td>$row[Setname]</td>";

		print("</tr>\n");
	}
		print("</table>\n");
	}
	
 ?>
</p>

<p>
	<a href="javascript:history.go(-1)">Tillbaka</a>
</p>
<p>
	<a href="ProjektTNMK30.html">Startsida</a>

</p>

</div>
</p>
</body>
</html>
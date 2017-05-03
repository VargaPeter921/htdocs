<html>
<head>
<meta charset="utf8">
<title>
	<?php 
		if (isset($_GET['category']))
		{
			echo $_GET['category'];
		}
		else
		{
			echo "Készletlista";
		}
	?>
</title></head>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

th {
    background-color: #4CAF50;
    color: white;
}
a:link, a:visited {
    background-color: #f44336;
    color: white;
    padding: 14px 25px;
    text-align: center; 
    text-decoration: none;
    display: inline-block;
}

a:hover, a:active {
    background-color: red;
}
</style>
<body>
<?php

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', '../' );
}
	if (isset($_GET['category']))
	{
		listTermekByCategory(null);
	}
	else if (isset($_GET['updateall']))
	{
		listTermekByCategory($_GET['updateall']);
	}
	else
	{
		if (isset($_GET['update']))
		{
			$soapClient = new SoapClient(
				'http://soap.cd-webshop.hu/webshopSoap.wsdl', array('encoding'=>'iso-8859-1')
			);
			$password = "20ebox15";

			$getXML = "
				<CategoryListRequest>
				<Header>
				<AuthCode>$password</AuthCode>
				</Header>
				</CategoryListRequest>
			";

			$resultXml = $soapClient->webshopSoap_categoryList($getXML);
			file_put_contents("./xml/category.xml",$resultXml);

			//listTermekByCategory();
		}


		$resultXml = file_get_contents("./xml/category.xml", true);
		$resultXml = str_replace("<![CDATA[", "", $resultXml);
		$resultXml = str_replace("&lt;![CDATA[", "", $resultXml);
		$resultXml = str_replace("]]>", "", $resultXml);
		$resultXml = str_replace("]]&gt;", "", $resultXml);

		$Json = json_encode(simplexml_load_string($resultXml));
		$data = json_decode($Json, true);

		//Adatbázis kapcoslódás
    	$link = mysql_connect("localhost", "eboxpchu", "9iPHl3cu57");
		mysql_select_db("eboxpchu_bolt", $link);
		mysql_set_charset('utf8',$link);
		

		if (isset($_GET['d']))
		{
			print_r(json_encode($data));
			echo '</br></br>';
		}
		else if (isset($_GET['t']))
		{
			$queryString = "TRUNCATE bolt_product;";
			mysql_query($queryString);
			
			$queryString = "TRUNCATE bolt_product_description;";
			mysql_query($queryString);

			$queryString = "TRUNCATE bolt_category;";
			mysql_query($queryString);

			$queryString = "TRUNCATE bolt_category_description;";
			mysql_query($queryString);

			$queryString = "TRUNCATE bolt_category_path;";
			mysql_query($queryString);

			$queryString = "TRUNCATE bolt_category_to_layout;";
			mysql_query($queryString);

			$queryString = "TRUNCATE bolt_category_to_store;";
			mysql_query($queryString);

			$queryString = "TRUNCATE bolt_product_to_category;";
			mysql_query($queryString);

			$queryString = "TRUNCATE bolt_product_to_store;";
			mysql_query($queryString);

		}
		else
		{
			echo "<table border='2px black'>";

	    	echo "<tr><th>Azonosító</th>";
	    	echo "<th>Kategórianév</th>";
	    	echo "<th></th></tr>";

	    	$cat = "";
	  
			//for ($i = 0; $i < 3; $i++)
			for ($i = 0; $i < count($data[Body][CategoryEntries][CategoryEntry]); $i++)
			{	
				echo "<tr>";
			    echo "<td>".$data[Body][CategoryEntries][CategoryEntry][$i][Id]."</td>";
			    echo "<td>".$data[Body][CategoryEntries][CategoryEntry][$i][Name]."</td>";
			    echo "<td><a href='list.php?category=".$data[Body][CategoryEntries][CategoryEntry][$i][Id]."&name=".$data[Body][CategoryEntries][CategoryEntry][$i][Name]."'>Lista betöltése</a></td>";
			    echo "</tr>";

			    $cat = $cat."__".$data[Body][CategoryEntries][CategoryEntry][$i][Id];

			    /*$queryString = "SELECT term_id as res FROM wp_terms WHERE slug = '".$data[Body][CategoryEntries][CategoryEntry][$i][Id]."'";
				echo "<p>Stringem: ".$queryString."</p></br>";

				$result = mysql_query($queryString);
				while ($row = mysql_fetch_object($result))
				{
				    echo 'RES: '.$row->res;
				    $webID = $row->res;
				}
				mysql_free_result($result);

				if ($webID > 0)
				{
					$queryString = "INSERT INTO wp_terms (slug, name, term_group) 
								VALUES ('".$data[Body][CategoryEntries][CategoryEntry][$i][Id]."', '".$data[Body][CategoryEntries][CategoryEntry][$i][Name]."', '0')";
					mysql_query($queryString);
					echo "<p>Stringem: ".$queryString."</p></br>";
				}*/
			}

			echo "<td><a href='list.php?updateall=".$cat."'>Mind letöltése</a></td>";
			echo "</table>";
		}
	}

	function listTermekByCategory($cat)
	{
		if (sizeof($cat) > 0)
		{
			$full = explode("__",$cat);
		}
		else
		{
			$full = 0;
		}

		for ($i = 0; $i < sizeof($full); $i++)
		{
			echo "</br>".$full[$i]."</br>";
		}

		if (isset($_GET['update']))
		{
			$soapClient = new SoapClient(
				'http://soap.cd-webshop.hu/webshopSoap.wsdl', array('encoding'=>'iso-8859-1')
			);
			$password = "20ebox15";
		    $getXML = "
				<ProductListRequest>
					<Header>
						<AuthCode>$password</AuthCode>
					</Header>
					<Body>
						<StructureEntry>
							<Description>true</Description>
							<ImageUrl>true</ImageUrl>
						</StructureEntry>
						<FilterEntry>
							<CategoryId>".$_GET['category']."</CategoryId>
						</FilterEntry>
					</Body>
				</ProductListRequest>
				";

			$resultXml = $soapClient->webshopSoap_productList($getXML);
			file_put_contents("./xml/".$_GET['category'].".xml",$resultXml);
		}

		$resultXml = file_get_contents("./xml/".$_GET['category'].".xml", true);
		$resultXml = str_replace("<![CDATA[", "", $resultXml);
		$resultXml = str_replace("&lt;![CDATA[", "", $resultXml);
		$resultXml = str_replace("]]>", "", $resultXml);
		$resultXml = str_replace("]]&gt;", "", $resultXml);

		//$Json = json_encode($resultXml);
		$Json = json_encode(simplexml_load_string($resultXml));

		$data = json_decode($Json, true);

		if (isset($_GET['d']))
		{
			print_r($Json);
		}
		else
		{
			echo "<a href='list.php'>Kezdőoldalra</a>";
			echo "<a href='list.php?category=".$_GET['category']."&update&name='".$_GET['category'].">Frissítés</a></br>";

			echo "Termékszám: ".count($data[Body][ProductEntries][ProductEntry])."</br>";
			echo "Zöld - Raktáron | Sárga - Úton | Piros - Rendelhető";
			echo "<table border='2px black'>";

			echo "<tr><th>Azonosító</th>";
	    	echo "<th>Terméknév</th>";
	    	echo "<th>Ár</th>";
	    	echo "<th>Kategória</th>";
	    	echo "<th>Kép</th>";
	    	echo "<th>Leírás</th></tr>";

			//Adatbázis kapcoslódás
	    	$link = mysql_connect("localhost", "eboxpchu", "9iPHl3cu57");
			mysql_select_db("eboxpchu_bolt", $link);
			mysql_set_charset('utf8',$link);

			//Kategória felvitele
			$queryString = "SELECT category_id as res FROM bolt_category_description WHERE name = '".$_GET['name']."'";
			echo "<p>ID kereső string: ".$queryString."</p></br>";

			$result = mysql_query($queryString);
			while ($row = mysql_fetch_object($result))
			{
			    echo 'RES: '.$row->res;
			    $categoryID = $row->res;
			}
			mysql_free_result($result);

			//Ha nincs meg, akkor felvesszük
			if ($categoryID === NULL || $categoryID == '0')
			{
				//A hozzáadott kategória beállítása
				$queryString = "INSERT INTO bolt_category (status, date_added, top)
											VALUES ('1', NOW(), '1')";
				echo "<p>Stringem: ".$queryString."</p></br>";
				mysql_query($queryString);
				mysql_free_result($result);

				//ID kinyerése
				$queryString = "SELECT category_id as res FROM bolt_category ORDER BY category_id DESC LIMIT 1";
				echo "<p>ID kereső string: ".$queryString."</p></br>";

				$result = mysql_query($queryString);
				while ($row = mysql_fetch_object($result))
				{
				    echo 'RES: '.$row->res;
				    $categoryID = $row->res;
				}
				mysql_free_result($result);

				//Kategória leírás hozzáadás
				$queryString = "INSERT INTO bolt_category_description (category_id, language_id, name, description, meta_title)
											VALUES ('".$categoryID."', '2', '".$_GET['name']."', '".$_GET['name']."', '".$_GET['category']."')";
				echo "<p>Stringem: ".$queryString."</p></br>";
				mysql_query($queryString);

				$queryString = "INSERT INTO bolt_category_path (category_id, path_id)
											VALUES ('".$categoryID."', '".$categoryID."')";
				echo "<p>Stringem: ".$queryString."</p></br>";
				mysql_query($queryString);	

				$queryString = "INSERT INTO bolt_category_to_layout (category_id)
											VALUES ('".$categoryID."')";
				echo "<p>Stringem: ".$queryString."</p></br>";
				mysql_query($queryString);	

				$queryString = "INSERT INTO bolt_category_to_store (category_id)
											VALUES ('".$categoryID."')";
				echo "<p>Stringem: ".$queryString."</p></br>";
				mysql_query($queryString);					
			}


			//for ($i = 0; $i < 10; $i++)
			for ($i = 0; $i < count($data[Body][ProductEntries][ProductEntry]); $i++)
			{	
				//Termék feltöltése az adatbázisba
				$webID = 0;

				$stock = $data[Body][ProductEntries][ProductEntry][$i][SimpleStock];
				//echo "<p>".$stock."</p>";
				if ($stock == 'Green')
				{
					$queryString = "SELECT manufacturer_id as res FROM bolt_product WHERE manufacturer_id = '".$data[Body][ProductEntries][ProductEntry][$i][Id]."'";
					echo "<p>ID kereső string: ".$queryString."</p></br>";

					$result = mysql_query($queryString);
					while ($row = mysql_fetch_object($result))
					{
					    echo 'RES: '.$row->res;
					    $webID = $row->res;
					}
					mysql_free_result($result);

					echo 'manufacturer_id: '.$webID;
					if ($webID != '0')
					{
						//Ha megvan a termék, frissítés
						$result = mysql_query("SELECT 1");
						while ($row = mysql_fetch_object($result))
						{
						    echo 'RES: '.$row->res;
						    $webID = $row->res;
						}
						mysql_free_result($result);
					}
					else if ($webID === NULL || $webID == '0')
					{

						$stock = $data[Body][ProductEntries][ProductEntry][$i][SimpleStock];
						$visible = '1';
						if ($stock == 'Red')
							$stock = 'outofstock';
						else if ($stock == 'Green')
							$stock = 'instock';
						else if ($stock == '' || $stock == null)
						{
							$stock = 'outofstock';
							$visible = '0';
						}

						//Képlementés
						if (is_array($data[Body][ProductEntries][ProductEntry][$i][ImageUrl]))
					    {
					    	$url = $data[Body][ProductEntries][ProductEntry][$i][ImageUrl][0];
					    }
					    else
					    {
							$url = $data[Body][ProductEntries][ProductEntry][$i][ImageUrl];
					    }

					    if ($url <> '')
					    {
						    $splitted = explode("/", $url);
							echo "<p>".$url."</p>";
							$img = $splitted[sizeof($splitted)-1];
							//echo "<p>".$img."</p>";

							$img = "catalog/prod/".$img;
							//echo "<p>".$img."</p>";

							$ch = curl_init($url);
							$fp = fopen($img, 'wb');
							curl_setopt($ch, CURLOPT_FILE, $fp);
							curl_setopt($ch, CURLOPT_HEADER, 0);
							curl_exec($ch);
							curl_close($ch);
							fclose($fp);
						}
						//képkész

						//Ha nincs meg a termék, akkor felvétel
						$queryString = "INSERT INTO bolt_product (
											model, sku, stock_status_id, image,
											manufacturer_id, shipping, price, tax_class_id, date_available,
											status, date_added, quantity)
										VALUES
											('".$data[Body][ProductEntries][ProductEntry][$i][Id]."', '".$data[Body][ProductEntries][ProductEntry][$i][Id]."', '6', '".$img."',
											'".$data[Body][ProductEntries][ProductEntry][$i][Id]."', '0', '".$data[Body][ProductEntries][ProductEntry][$i][Price]."', '9', NOW(),
											'".$visible."', NOW(), '".$data[Body][ProductEntries][ProductEntry][$i][StockValue]."')";

						echo "<p>Stringem: ".$queryString."</p></br>";
						mysql_query($queryString);
						echo 'Termék feltöltése kész';

						$queryString = "SELECT product_id as res FROM bolt_product WHERE manufacturer_id = '".$data[Body][ProductEntries][ProductEntry][$i][Id]."'";
						echo "<p>ID kereső string: ".$queryString."</p></br>";

						$result = mysql_query($queryString);
						while ($row = mysql_fetch_object($result))
						{
						    echo 'RES: '.$row->res;
						    $productID = $row->res;
						}
						mysql_free_result($result);

						//Ha nincs meg a termék, akkor felvétel
						$queryString = "INSERT INTO bolt_product_description (
											product_id, language_id, name, 
											description, meta_title)
										VALUES
											('".$productID."', '2', '".$data[Body][ProductEntries][ProductEntry][$i][Name]."',
											'".$data[Body][ProductEntries][ProductEntry][$i][Description]."', '".$data[Body][ProductEntries][ProductEntry][$i][Id]."')";

						echo "<p>Stringem: ".$queryString."</p></br>";
						mysql_query($queryString);

						$queryString = "INSERT INTO bolt_product_to_category (product_id, category_id)
										VALUES ('".$productID."','".$categoryID."')";
						echo "<p>Stringem: ".$queryString."</p></br>";
						mysql_query($queryString);
						
						$queryString = "INSERT INTO bolt_product_to_store (product_id, store_id)
										VALUES ('".$productID."','0')";
						echo "<p>Stringem: ".$queryString."</p></br>";
						mysql_query($queryString);

						echo 'Termék feltöltése kész';
					}
					echo "<tr bgcolor='".$data[Body][ProductEntries][ProductEntry][$i][SimpleStock]."'>";
				
				    echo "<td>".$data[Body][ProductEntries][ProductEntry][$i][Id]."</td>";
				    echo "<td>".$data[Body][ProductEntries][ProductEntry][$i][Name]."</td>";
				    echo "<td>Nettó: ".$data[Body][ProductEntries][ProductEntry][$i][Price]." Ft</br>";
				    echo "Bruttó:".($data[Body][ProductEntries][ProductEntry][$i][Price]*1.27)." Ft</br>";
				    echo "Eladási:".(($data[Body][ProductEntries][ProductEntry][$i][Price]*1.27)*1.15)." Ft</td>";
				    echo "<td>Kategória: ".$data[Body][ProductEntries][ProductEntry][$i][CategoryId]."</td>";

					echo "<td> ";
				    if (is_array($data[Body][ProductEntries][ProductEntry][$i][ImageUrl]))
				    {
						for ($x = 0; $x < count($data[Body][ProductEntries][ProductEntry][$i][ImageUrl]); $x++)
					    {
					    	echo "<img src='".$data[Body][ProductEntries][ProductEntry][$i][ImageUrl][$x]."' height='250' width='250'>";
						}
				    }
				    else
				    {
				    	echo "<img src='".$data[Body][ProductEntries][ProductEntry][$i][ImageUrl]."' height='250' width='250'>";
				    }
				    
					echo "</td>";
				    echo "<td>".$data[Body][ProductEntries][ProductEntry][$i][Description]."</td>";
				    echo "</tr>";
				}
			}
			echo "</table>";
		}
	}
?>
</body>
</html>
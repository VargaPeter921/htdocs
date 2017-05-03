<body>
	<p><a href="?cikk">Cikkfeldolgozás</a></p>
	<p><a href="?cikk&update">Cikkeletöltés</a></p>

	<p><a href="?ar&allProc">Árfeldolgozás</a></p>
	<p><a href="?ar&getAr">Árlekérés</a></p>
</body>

<?php
	require_once 'scripts/functions.php';
	ini_set('memory_limit', '1000M');
	ini_set('max_execution_time','30000');

	if (isset($_GET['cikk']))
	{
		$file = storage_path()."/xml/expert/full.xml";
		
		if (isset($_GET['update']))
		{
			$authcode = "23C2A04A-915C-4E13-A1C3-5198436E9FD5";
			$client = new SoapClient('http://www.expert.hu/services/vision.asmx?WSDL',array("trace" => 1,"exceptions" => 0));
			$result = $client->GetCikkekAuth(array('web_update'=>'2017-02-01-10:00', 'authcode'=>$authcode));
			print_r($result);
			
			/*$Json = json_encode(simplexml_load_string($result));
			file_put_contents($file,$Json);

			$myfile = fopen($file, "w") or die("Unable to open file!");
			fwrite($myfile, $result);
			fclose($myfile);*/
		}

		else
		{
			$resultXml = file_get_contents($file, true);
			$xml = simplexml_load_string($resultXml);

			/*echo '<pre>';
			print_r($xml);
			echo '</pre>';*/

			for ($i = 0; $i < sizeOf($xml->cikk); $i++)
			//for ($i = 0; $i < 25; $i++)
			{
				$meglevoTermek = DB::select('SELECT * FROM termeks WHERE cikkid = "'.$xml->cikk[$i]->attributes()->cikkid.'" LIMIT 1');
				if (sizeOf($meglevoTermek) > 0)
				{
					echo $xml->cikk[$i]->cikknev.' már megtalálható: '.$xml->cikk[$i]->attributes()->cikkid.'</br>';

					$kepszam = DB::select('SELECT COUNT(cikkid) AS count FROM termekkep WHERE cikkid = "'.$xml->cikk[$i]->attributes()->cikkid.'"');
					if ($kepszam[0]->count == 0)
					{
						try
						{
							kepLetoltes($xml->cikk[$i]->attributes()->cikkid, $i);
						}
						catch (Exception $a)
						{
							echo $a.'</br>';
						}
					}
				}
				else
				{
					$meglevoGyarto = DB::select('SELECT id FROM gyartos WHERE name = "'.$xml->cikk[$i]->gyarto.'" LIMIT 1');
					if (sizeOf($meglevoGyarto) == 0)
					{
						DB::table('gyartos')->insert(['name' => $xml->cikk[$i]->gyarto]);
						$meglevoGyarto = DB::select('SELECT id FROM gyartos WHERE name = "'.$xml->cikk[$i]->gyarto.'" LIMIT 1');
					}
					$gyarto = $meglevoGyarto[0]->id;

					try
					{
						kepLetoltes($xml->cikk[$i]->attributes()->cikkid, $i);
					}
					catch (Exception $a)
					{
						echo $a;
					}

					DB::table('termeks')->insert(
						[
						'cikkid' => $xml->cikk[$i]->attributes()->cikkid, 
						'cikkszam' => $xml->cikk[$i]->cikkszam, 
						'cikkszam2' => $xml->cikk[$i]->cikkszam2, 
						'cikknev' => $xml->cikk[$i]->cikknev, 
						'mennyiseg' => $xml->cikk[$i]->mennyiseg, 
						'kshszam' => $xml->cikk[$i]->kshszam, 
						'gyarto' => $gyarto, 
						'cikkcsoportkod' => $xml->cikk[$i]->cikkcsoportkod, 
						'cikkcsoportnev' => $xml->cikk[$i]->cikkcsoportnev, 
						'tipus' => $xml->cikk[$i]->tipus, 
						'beszerzesiallapot' => $xml->cikk[$i]->beszerzesiallapot, 
						'webigendatum' => $xml->cikk[$i]->webigendatum, 
						'webmegjel' => $xml->cikk[$i]->webmegjel, 
						'leiras' => $xml->cikk[$i]->leiras, 
						'tomeg' => $xml->cikk[$i]->tomeg, 
						'gartipusid' => $xml->cikk[$i]->gartipusid, 
						'garido' => $xml->cikk[$i]->garido, 
						'garidotipus' => $xml->cikk[$i]->garidotipus, 
						'garhely' => $xml->cikk[$i]->garhely, 
						'meret' => $xml->cikk[$i]->meret, 
						'garhelytipus' => $xml->cikk[$i]->garhelytipus, 
						'arlistapoz' => $xml->cikk[$i]->arlistapoz, 
						'megj' => $xml->cikk[$i]->megj, 
						'cikkfajta' => $xml->cikk[$i]->cikkfajta, 
						'gycikkszam' => $xml->cikk[$i]->gycikkszam, 
						'focsoportkod' => $xml->cikk[$i]->focsoportkod, 
						'focsoportnev' => $xml->cikk[$i]->focsoportnev, 
						'cikkjellnev' => $xml->cikk[$i]->cikkjellnev, 
						'ertmenny' => $xml->cikk[$i]->ertmenny, 
						'szigoru_szamadasu' => $xml->cikk[$i]->szigoru_szamadasu, 
						'source' => '1',
						]
					);
				}
			}
		}
	}

	if (isset($_GET['ar']))
	{
		if (isset($_GET['getAr']))
		{
			$authcode = "23C2A04A-915C-4E13-A1C3-5198436E9FD5";
			$client = new SoapClient('http://www.expert.hu/services/vision.asmx?WSDL',array("trace" => 1,"exceptions" => 0));

			$resultXml = file_get_contents($file, true);
			$xml = simplexml_load_string($resultXml);

			$result = $client->GetArakAuth(array('cikkekxml'=>$xml, 'authcode'=>$authcode));
			print_r($result);

			$file = storage_path()."/xml/expert/arak.xml";
			
			$Json = json_encode(simplexml_load_string($result));
			file_put_contents($file,$Json);

			$myfile = fopen($file, "w") or die("Unable to open file!");
			fwrite($myfile, $result);
			fclose($myfile);
		}

		if (isset($_GET['getArlista']))
		{
			$authcode = "23C2A04A-915C-4E13-A1C3-5198436E9FD5";
			$client = new SoapClient('http://www.expert.hu/services/vision.asmx?WSDL',array("trace" => 1,"exceptions" => 0));

			$result = $client->GetArlista(array('pid'=>'46932', 'partnerkod'=>'19941', 'authcode'=>$authcode));
			print_r($result);

			$file = storage_path()."/xml/expert/mindenAr.xml";
			
			$Json = json_encode(simplexml_load_string($result));
			file_put_contents($file,$Json);

			$myfile = fopen($file, "w") or die("Unable to open file!");
			fwrite($myfile, $result);
			fclose($myfile);
		}

		if (isset($_GET['allProc']))
		{
			echo '<p>Árfeldolgozás</p>';

			$file = storage_path()."/xml/expert/allPrice.xml";
			$resultXml = file_get_contents($file, true);
			$xml = simplexml_load_string($resultXml);

			echo $xml->arak->ar[0]->cikkid.'</br>';

			echo 'Árak: '.sizeOf($xml->arak->ar).'</br>';

			echo '<pre>';
			//print_r($xml);
			echo '</pre>';		
			
			for ($i = 0; $i < sizeOf($xml->arak->ar); $i++)
			{
				$meglevo = DB::select('SELECT 1 AS ret FROM termekar WHERE cikkid = "'.$xml->arak->ar[$i]->cikkid.'" LIMIT 1');

				if (empty($meglevo))
				{
					DB::table('termekar')->insert(
						[
						'cikkid' => $xml->arak->ar[$i]->cikkid, 
						'listaAr' => $xml->arak->ar[$i]->listaar, 
						'akciosAr' => $xml->arak->ar[$i]->akcios_ar, 
						'normalAr' => $xml->arak->ar[$i]->ar, 
						'devizanem' => $xml->arak->ar[$i]->devizanem
						]
					);
				}
				else
				{
					DB::update('UPDATE termekar SET listaAr = ? AND akciosAr = ? AND normalAr = ? AND devizanem = ? WHERE cikkid = ?', 
						[$xml->arak->ar[$i]->listaar, $xml->arak->ar[$i]->akcios_ar, $xml->arak->ar[$i]->normalAr, $xml->arak->ar[$i]->devizanem, $xml->arak->ar[$i]->cikkid]);
				}
			}
		}
	}

	function kepLetoltes($cikkid, $i)
	{
		$re = '/\'\/images\/cikkek.*\'/';
		$html = 'http://www.expert.hu/cikkek/reszletek/kepek/pag_cikkekkepei.aspx?CIKKID='.$cikkid;
		$html2 = file_get_contents($html);

		preg_match_all($re, $html2, $matches, PREG_OFFSET_CAPTURE, 0);

		foreach($matches[0] as $image)
		{
			$imageFromExpert = str_replace('\'', '', $image[0]);
			$url = 'http://www.expert.hu'.$imageFromExpert;
			$img = $imageFromExpert;

			echo 'URL: '.$url.'</br>';
			echo 'Mentés helye: ./'.$img.'</br>';

			if (!file_exists($img))
			{
				$pathArr = explode("/", $img);
				$folder = explode(end($pathArr), $img);

				$imageFolder = str_replace(' ', '-', $folder[0]);
				echo 'Mappa: '.$imageFolder.'</br>';

				if (!file_exists($imageFolder)) {
					mkdir($imageFolder, 0777, true);
				}

				/*$ch = curl_init($url);
				$fp = fopen('./'.$img, 'wb');
				curl_setopt($ch, CURLOPT_FILE, $fp);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_exec($ch);
				curl_close($ch);
				fclose($fp);*/
			}

			DB::table('termekkep')->insert(
			[
				'cikkid' => $cikkid, 
				'kepEleres' => $imageFromExpert
			]
			);
		}
	}
?>
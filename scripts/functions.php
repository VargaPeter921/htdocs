<?php
	function termekCheck($focsoportnev, $termekszures, $keres)
	{
		$tax = DB::select('SELECT value FROM la_configs WHERE `key` = "pricetax"');
		$profit = DB::select('SELECT value FROM la_configs WHERE `key` = "profit"');

		if ($focsoportnev != '')
			$focsoportnev = 'AND TS.focsoportnev = "'.$focsoportnev.'"';
		else $focsoportnev = null;

		if ($termekszures != '')
			$termekszures = 'AND cikkid NOT IN('.$termekszures.')';
		else $termekszures = null;

		if (!empty($arSzures))
		{
			$arSzures = ' AND (normalAr*'.$tax[0]->value*$profit[0]->value.') BETWEEN '.$arSzures[0].' AND '.$arSzures[1].' ';
		}
		else $arSzures = null;

		if ($keres != '')
		{
			$accents = array('+',' ');
			foreach ($accents as $key)
				$keres = str_replace($key, '%', $keres);
			
			$keres = 'AND CONCAT_WS(\' \', cikknev, leiras, megj, cikkcsoportnev, cikkfajta, focsoportnev) like "%'.$keres.'%"';
		}
		else $keres = null;

		$ftermek = DB::select('SELECT COUNT(*) as count FROM termeks AS TS WHERE TS.webmegjel = 1 AND TS.beszerzesiallapot = 1 '.$termekszures.' '.$focsoportnev.' '.$keres.' AND EXISTS (SELECT 1 FROM termekar WHERE cikkid = TS.cikkid AND normalAr > 0 '.$arSzures.')');

		return $ftermek[0]->count;
	}

	function termekLekeres($db, $focsoportnev, $keres, $arSzures, $kellKep, $rand)
	{
		$tax = DB::select('SELECT value FROM la_configs WHERE `key` = "pricetax"');
		$profit = DB::select('SELECT value FROM la_configs WHERE `key` = "profit"');

		if ($db != '')
			$db = 'LIMIT '.$db;
		else $db = null;

		if ($rand)
			$rand = 'RAND() ASC';
		else $rand = 'ID ASC';

		//Szűrések beállítása
		if ($focsoportnev != '')
			$focsoportnev = 'AND TS.focsoportnev = "'.$focsoportnev.'"';
		else $focsoportnev = null;

		if (!empty($arSzures))
		{
			$arSzures = ' AND (TA.normalAr*'.$tax[0]->value*$profit[0]->value.') BETWEEN '.$arSzures[0].' AND '.$arSzures[1].' ';
		}
		else $arSzures = null;

		if ($keres != '')
		{
			$accents = array('+',' ');
			foreach ($accents as $key)
				$keres = str_replace($key, '%', $keres);
			
			$keres = 'AND CONCAT_WS(\' \', cikknev, leiras, megj, cikkcsoportnev, cikkfajta, focsoportnev, gycikkszam) like "%'.$keres.'%"';
		}
		else $keres = null;

		if ($kellKep != '')
			$kellKep = 'AND EXISTS (SELECT 1 FROM termekkep WHERE cikkid = TS.cikkid)';
		else $kellKep = null;

		//Termék lekérése
		$ftermek = DB::select('SELECT TS.*, TA.* FROM termeks AS TS LEFT JOIN termekar AS TA ON TA.cikkid = TS.cikkid LEFT JOIN gyartos AS GY ON GY.id = TS.gyarto WHERE TS.webmegjel = 1 AND TS.beszerzesiallapot = 1 AND TA.normalAr > 0 AND TA.akciosAr > 0 '.$focsoportnev.' '.$keres.' '.$kellKep.' '.$arSzures.' ORDER BY '.$rand.' '.$db);

		if (empty($ftermek))
		{
			$ftermek = null;
			$termekkep = null;
		}
		else
		{			
			//Termékkép lekérés
			$x = 0;
			foreach($ftermek as $termek)
			{
				$termekkep[$x] = DB::select('SELECT * FROM termekkep WHERE cikkid = "'.$termek->cikkid.'" ORDER BY '.$rand.'');
				foreach($termekkep[$x] as $kep)
				{
					if (empty($kep) && !file_exists($_SERVER['DOCUMENT_ROOT'].$kep->kepEleres))
					{
						$kep->kepEleres = "/images/default.jpg";
					}
				}
				$x++;
			}
		}
		
		return array ($ftermek, $termekkep);
	}
	
	function kategoriaLekeres()
	{
		$res = $db->query('SELECT * FROM termeks WHERE webmegjel = 1 AND beszerzesiallapot = 1 ORDER BY RAND() LIMIT 1');
		if (!empty($res))
		{
			while($row = $res->fetch(PDO::FETCH_ASSOC)) {
				$cikkNev = $row['cikknev'];
				$termekID = $row['ID'];
				$megj = $row['megj'];
			}
		}
	}

	function clean($string)
	{
		$string = str_replace(' ', '-', $string);

		$accents = array(
			'á' => 'a', 'Á' => 'A',
			'ä' => 'a', 'Ä' => 'A',
			'é' => 'e', 'É' => 'E',
			'í' => 'i', 'Í' => 'I',
			'ó' => 'o', 'Ó' => 'O',
			'ö' => 'o', 'Ö' => 'O',
			'ő' => 'o', 'Ő' => 'O',
			'ú' => 'u', 'Ú' => 'U',
			'ü' => 'u', 'Ü' => 'U',
			'ű' => 'u', 'Ű' => 'U'
		);
		
		foreach ($accents as $key => $val)
		{
			$string = preg_replace('#'.$key.'#', $val, $string);
		}

		return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
	}

	function echoTermekKep($termekkep, $nev, $num, $def, $cikkid, $big)
	{
		if ($termekkep == "null")
		{
			/*try {
				$search_keyword = str_replace(' ', '+', $nev);
				$resultJson = file_get_contents("https://www.googleapis.com/customsearch/v1?q=".$search_keyword."&cr=hu&cx=009779612865427837205%3Axpxtwdfwsey&filter=1&num=3&searchType=image&key=AIzaSyBmm4a7XWSY_n_MTMFWiGT9TYdcjvttvRk");
				$resultJson = json_decode($resultJson);

				$img = '/images/termekek/'.date("y").'/'.date("m").'/google_'.$search_keyword.'_'.$num.'.jpg';
				file_put_contents($img, file_get_contents($resultJson->items[$num]->link));
				$link = $resultJson->items[$num]->image->contextLink;
				
				DB::insert('INSERT INTO termekkep (termekID, kepEleres, kepForras) values (?, ?, ?)', [$termekid, $img, $link]);
				$termekkep = DB::select('SELECT * FROM termekkep WHERE termekID = ? ORDER BY ID ASC', [$termekid]);
				echo '<img src="'.$termekkep[$num+1]->kepEleres.'" alt="'.$nev.'"/>';
			}
			catch (Exception $a)
			{
				echo '<img src="'.$def.'" alt="'.$nev.'"/>';
			}*/
			echo '<img src="'.$def.'" alt="'.$nev.'"/>';
		}
		else
		{
			try {
				$termekkep = DB::select('SELECT * FROM termekkep WHERE cikkid = ? ORDER BY ID ASC', [$cikkid]);
				if ($termekkep[$num+1]->kepForras !== NULL && $big)
				{
					echo '<img src="'.$termekkep[$num+1]->kepEleres.'" alt="'.$nev.'"/>';
					echo '<a href="'.$termekkep[$num+1]->kepForras.'" target="_blank">A kép forrásának megtekintése</a>';
				}
				else if(!$big)
				{
					echo '<img src="'.$termekkep[$num+1]->kepEleres.'" alt="'.$nev.'"/>';
				}
			}
			catch (Exception $a)
			{
				echo '<img src="'.$def.'" alt="'.$nev.'"/>';
			}
		}		
	}

	function echoAr($normal, $ar)
	{
		$tax = DB::select('SELECT value FROM la_configs WHERE `key` = "pricetax"');
		$profit = DB::select('SELECT value FROM la_configs WHERE `key` = "profit"');

		if (!empty($ar))
		{
			try
			{
				if ($ar->normalAr <> $ar->akciosAr && $ar <> 0)
				{
					$ar = $ar->akciosAr;
				}
				else
				{
					$ar = $ar->normalAr;
				}

				if ($normal == 1)
					$ret = number_format(ceil(($ar)*$tax[0]->value*$profit[0]->value), 0, ',', ' ');
				else
					$ret = number_format(ceil(($ar)*$profit[0]->value), 0, ',', ' ');

				return $ret;
			}
			catch (Exception $a)
			{
				return 0;
			}
		}
		else return 0;
	}

	function returnAr($normal, $ar)
	{
		if (!empty($ar))
		{
			if ($normal == 1)
				$ret = floor(($ar)*1.27);
			else
				$ret = floor($ar);

			return $ret;
		}
		else return 0;
	}

	function headerRow($termek, $category)
	{
		$cat = '';
		if (!empty($termek))
			$cat = '<a href="/bolt?kategoria='.$termek->focsoportnev.'"> > '.$termek->focsoportnev.'</a><a href="#"> > '.$termek->cikknev.'</a>';
		if (!empty($category))
		{
			$cat = '<a href="/bolt?kategoria='.$category.'"> > '.$category.'</a>';
		}

		if (isset($_GET['kategoria']))
			$kat = '<input hidden name="kategoria" value="'.$_GET['kategoria'].'">';
		else $kat = '';

		if (isset($_GET['pf']))
			$arMin = $_GET['pf'];
			else $arMin = 0;
		if (isset($_GET['pt']))
			$arMax = $_GET['pt'];
			else $arMax = 0;

		$kategoriak = DB::select('select focsoportnev, count(*) as db from termeks AS TS WHERE TS.webmegjel = "1" AND TS.beszerzesiallapot = "1" AND focsoportnev <> "" AND EXISTS (SELECT 1 FROM termekar WHERE cikkid = TS.cikkid AND normalAr > 0) group by focsoportnev ');
		
		echo '
			<script src="/scripts/jquery-1.10.2.min.js"></script>
			<script src="/scripts/bootstrap.min.js"></script>
			<link href="/styles/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

			<div id="categories">
  				<nav class="navbar bKategoria">
    			<div class="collapse navbar-collapse js-navbar-collapse">
      				<ul class="navbar-nav">
        				<li class="dropdown mega-dropdown">
         					<a href="#" data-toggle="dropdown">Kategóriák</span></a>
          					<ul class="dropdown-menu mega-dropdown-menu row">
            				<li class="col-sm-3">
              					<ul>
                				<li class="dropdown-header">Kiemelt ajánlatok</li>
                					<div id="myCarousel" class="carousel slide" data-ride="carousel">
										<div class="carousel-inner">
											';
											
											for ($i = 1; $i <= 3; $i++)
											{
												if ($i != 1)
													$act = "";
												else $act = "active";

												$ret = termekLekeres('','0','', '',true);

												echo '<div style="width: 250px; height: 250px; margin: auto;" class="item '.$act.'">
														<a href="/'.$ret[5].'-t'.str_pad($ret[4], 6, '0', STR_PAD_LEFT).'"><img style="max-width: 250px; max-height: 150px; " src="'.$ret[1].'" class="img-responsive" alt="product '.$i.'"></a>
														<h4><small>'.$ret[0].'</small></h4>
														<button class="btn btn-primary" type="button">'.echoAr(1, $ret[2]).' Ft</button>
													</div>';
											}
											echo '
										</div>
									</div>
								</ul>
							</li>
							';

							foreach($kategoriak as $kategoria)
							echo '
							<li class="col-sm-3">
								<ul>
									<li class="dropdown-header"><a href="/bolt?kategoria='.$kategoria->focsoportnev.'">'.$kategoria->focsoportnev.' ('.$kategoria->db.')</a></li>
								</ul>
							</li>';
							echo '
						</ul>
					</li>
				</ul>
			</div>
			<!-- /.nav-collapse -->
		</nav>
	</div>';






			

			echo '<div id="ar">
			<form action="/bolt" method="get">'.$kat.'
				Ár <input text name="pf" value="'.$arMin.'"/>
				 - <input text name="pt" value="'.$arMax.'"/>
				<input type="submit" value="Szűrés">
				</form>
			</div>';


			echo '<div id="filter">
				Szűrés
			</div>
			</div>';
			
			echo '<div id="oldalak">
				<a href="/">Főoldal</a>
				<a href="/bolt"> > Bolt</a>
				'.$cat.'
			</div>';
	}
?>
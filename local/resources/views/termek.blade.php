<?php

	if(substr($_SERVER['REQUEST_URI'], -7)[0] == 't')
	{
		try
		{
			$id = substr($_SERVER['REQUEST_URI'], -6);
			$termek = DB::select('SELECT * FROM termeks WHERE id = ?', [$id]);
			$termekar = DB::select('SELECT * FROM termekar WHERE cikkid = ?', [$termek[0]->cikkid]);
			if (!empty($termekar))
				$termekar = $termekar[0];
			else
				$termekar = 0;

			echo '<title>'.$termek[0]->cikknev.' - Ebox Informatika Kft</title>';		

			$pages = "pages/";
			$styles = "styles/";
			$scripts = "scripts/";
			$images = "images/";
			$d = "/";
			$def = $images."default.jpg";

			$vanKep = true;
			$termekkep = DB::select('SELECT * FROM termekkep WHERE cikkid = "'.$termek[0]->cikkid.'" ORDER BY ID');
			if (empty($termekkep))
				$vanKep = false;
			
			include $pages.'header.php';
			include_once($scripts.'simple_html_dom.php');

			?>
			<div id="body">

			<?php
				require_once $pages.'logoSmall.php';
				require $scripts.'functions.php';

				headerRow($termek[0], null);
			?>

			<table id="termekBody">
			<tr><td>
				<div id="termekKepek">
					<div class="bigimages">
						<?php for ($i = 1; $i <= 3; $i++) {
							echo '
							<div id="normal'.$i.'">';
							if ($vanKep)
							{
								if (!empty($termekkep[$i-1])  && file_exists($_SERVER['DOCUMENT_ROOT'].$termekkep[$i-1]->kepEleres))
								{
									$kep = $termekkep[$i-1]->kepEleres;
									echo '<a href="#" class="normalMouse">
										<div class="lightbox-target" id="b'.$i.'">
											<img class="hover" id="biggerBigImage" src="'.$kep.'" alt="'.clean($termek[0]->cikknev).'" />
										</div>
									</a>';
								}
								else
									$kep = $def;
							}
							else
								$kep = $def;							
							echo'<a href="#b'.$i.'">
									<img class="hover" src="'.$kep.'" alt="'.clean($termek[0]->cikknev).'" />
									</a>
							</div>'; } ?>
					</div>

					<div id="thumbs">
						<div class="thumbImage">
						<?php for ($i = 1; $i <= 3; $i++) {
							if ($vanKep)
							{
								if (!empty($termekkep[$i-1]) && file_exists($_SERVER['DOCUMENT_ROOT'].$termekkep[$i-1]->kepEleres))
									$kep = $termekkep[$i-1]->kepEleres;
								else
									$kep = $def;
							}
							else
								$kep = $def;
							echo '<a href="javascript: changeImage('.$i.');">';
							echo '<img class="hover" src="'.$kep.'" alt="'.clean($termek[0]->cikknev).'"/>';
							echo '</a>'; } ?>
							</div>
					</div>
				</div>
				</td><td>
				<div id="termekLeiras">
					<p id="termekesCim"><?php echo $termek[0]->cikknev; ?></p>
						<?php
							//Ha van leírás, akkor mindkét felület kiírása, ha nincs, akkor csak a megjegyzést
							if (!empty($termek[0]->leiras))
							{
								echo '<a id="leiras" onclick="replace(\'aSpecifikacio\',\'aLeiras\')">Leírás</a>
									<a id="specifikacio" onclick="replace(\'aLeiras\',\'aSpecifikacio\')">Specifikáció</a>
									
									<div id="leirasSpecSzoveg">
									<div id="aLeiras" style="display:block">'.$termek[0]->leiras.'</div>
									<div id="aSpecifikacio" style="display:none">'.$termek[0]->megj.'</div>
									</div>';
							}
							else
							{
								echo '<div id="leiras">Specifikáció</div>
									<div id="leirasSpecSzoveg"><div id="aSpecifikacio" style="display:block">'.$termek[0]->megj.'</div></div>';
							}
							?>
					</div>
				</td><td>
				<div id="termekRendeles">
					<div id="termekNetto"><?php echo echoAr(1, $termekar); ?> Ft</div>
					<div id="termekBrutto">Nettó: <?php echo echoAr(0, $termekar); ?> Ft</div>
					<a href="#"><div id="rend">Kosárba <c class="fa fa-shopping-cart"/></div></a>
					<a href="#"><div id="rend">Kedvencekhez <c class="fa fa-heart"/></div></a>
					<!--<div id="rend">Raktáron:</div>
					<div id="rend">Átvétel:</div>
					<div id="rend">Szállítás:</div>
					-->
				</div>
				</td><td>
				<div id="termekHasonlo">
					<p id="termekesCim">Hasonló Termékek</p>
					<table>
					<?php
						$ret = termekLekeres(13,$termek[0]->focsoportnev,'', '','');

						for ($x = 0; $x < 3; $x++)
						{
							echo '<tr>';
							for ($i = 0; $i < 4; $i++)
							{
								if ($ret[0] != '0'){
								echo '
										<td>
											<a href="/'.$ret[0][0]->focsoportnev.'-t'.str_pad($ret[0][0]->ID, 6, '0', STR_PAD_LEFT).'">
												<div class="hasonloTermek">
													<div class="hasonloTermekKep">
														<img class="hover" src="'.$ret[1][0][0]->kepEleres.'" alt="'.$ret[0][0]->cikknev.'">
													</div>
													<div class="termekCim">
														'.$ret[0][$i+1]->cikknev.'
													</div>
													<div class="termekAr">
														'.echoAr(1, $ret[0][$i+1]).' Ft
													</div>
												</div>
											</a>
										</td>
										';
								}
							}
							echo '</tr>';
						}
					?>
					</table>
				</div>
				</td></tr>
			</table>
			<?php
				require $pages.'footer.php';
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	else
	echo '404';
?>
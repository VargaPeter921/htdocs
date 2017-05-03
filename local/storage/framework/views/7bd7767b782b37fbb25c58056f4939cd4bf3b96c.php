<?php
	$pages = "pages/";
	$styles = "styles/";
	$scripts = "scripts/";
	$images = "images/";
	$d = "/";
	
	include $pages.'header.php';
?>
<body onload="currentDiv(1);">
<div id="body">

<?php
	include $pages.'logo.php';
	require $scripts.'functions.php';
?>

<div id="topmid">
	<div id="okosotthon">
		<img src="images/okosotthon.gif" onmouseover="this.src='images/okosotthon_hover.jpg'" onmouseout="this.src='images/okosotthon.gif'">
		<div class="midCim">
			Kezdőlap
		</div>

	</div>
	<div id="webshop">
		<a href="./bolt">
			<img src="images/webshop.gif" onmouseover="this.src='images/webshop_hover.jpg'" onmouseout="this.src='images/webshop.gif'">
		</a>
		<div class="midCim">
			Bolt
		</div>
	</div>
	<div id="projektor">
		<img src="images/projektor.gif" onmouseover="this.src='images/projektor_hover.jpg'" onmouseout="this.src='images/projektor.gif'" width="235">
		<div class="midCim midCimSmall">
			Projektor bérlés
		</div>
	</div>
	<div id="aboutus">
		<img src="images/aboutus.gif" onmouseover="this.src='images/aboutus_hover.jpg'" onmouseout="this.src='images/aboutus.gif'" width="235">
		<div class="midCim midCimSmall">
			Rólunk
		</div>
	</div>
</div>

<div id="topright">
	<div id="topRight_R1_01">
		<?php
			$ret = termekLekeres(6,'','','',true, true);
			echo '<a href="/'.$ret[0][0]->focsoportnev.'-'.clean($ret[0][0]->cikknev).'-t'.str_pad($ret[0][0]->ID, 6, '0', STR_PAD_LEFT).'">
			<div class="rImage">
				<img class="hover" src="'.$ret[1][0][0]->kepEleres.'" alt="'.$ret[0][0]->cikknev.'">
			</div>
			<div id="rText">
				'.$ret[0][0]->cikknev.'</br>'.echoAr(1, $ret[0][0]).' Ft
			</div></a>';
		?>
	</div>
	<div id="topRight_R1_02">
		<?php
			echo '<a href="/'.$ret[0][1]->focsoportnev.'-'.clean($ret[0][1]->cikknev).'-t'.str_pad($ret[0][1]->ID, 6, '0', STR_PAD_LEFT).'">
			<div class="rImage">
				<img class="hover" src="'.$ret[1][1][0]->kepEleres.'" alt="'.$ret[0][1]->cikknev.'">
			</div>
			<div id="rText">
				'.$ret[0][1]->cikknev.'</br>'.echoAr(1, $ret[0][1]).' Ft
			</div></a>';
		?>
	</div>
	
	<div id="banner">
		<a href="http://www.justabit.ebox-pc.hu/"><img src="images/justabit.jpg" alt=""></a>
	</div>
</div>

<div id="termekek">

	<?php 
	for ($i = 1; $i <= 4; $i++)
		{
			echo '
				<div class="termek termek'.$i.'">
				<td>
					<a href="/'.$ret[0][$i+1]->focsoportnev.'-'.clean($ret[0][$i+1]->cikknev).'-t'.str_pad($ret[0][$i+1]->ID, 6, '0', STR_PAD_LEFT).'">
					<div class="termek">
						<div class="termekKep">
							<img class="hover" src="'.$ret[1][$i+1][0]->kepEleres.'" alt="'.$ret[0][$i+1]->cikknev.'">
						</div>
						<span class="termekText"><span>
							'.$ret[0][$i+1]->cikknev.'</br>'.$ret[0][$i+1]->megj.'
						</span></span>
						<div class="termekCim">
							'.$ret[0][$i+1]->cikknev.'
						</div>
						<div class="termekAr">
							'.echoAr(1, $ret[0][$i+1]).' Ft
						</div>
					</div></a>
				</td>
				</div>';
		}
	?>
</div>

<div id="leftR1">
	<div id="map">
		<iframe frameborder="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBHKP4C6ic-cC_HGsjIn_uA5knqUvdHaic&q=Ebox+Informatika+Kft.+Szeged">
		</iframe>
		
		<div class="utvonal">
			<a target="_blank" href="https://maps.google.com?saddr=Current+Location&daddr=Ebox+Informatika+Kft.+Szeged">
			6723, Szeged, Debreceni utca 32 - Útvonaltervezés</a>
		</div>
	</div>
</div>

<div id="leftR2">
	<div id="slider">
		<img class="mySlides" src="images/slider_01.jpg">
		<img class="mySlides" src="images/slider_02.png">
		<div class="w3-center w3-display-bottommiddle" style="width:100%">
			<div class="w3-left" onclick="plusDivs(-1)">&#10094;</div>
			<div class="w3-right" onclick="plusDivs(1)">&#10095;</div>
			<span class="w3-badge w3-border w3-hover-white" onclick="currentDiv(1)"></span>
			<span class="w3-badge w3-border w3-hover-white" onclick="currentDiv(2)"></span>
		</div>
	</div>
</div>

<div id="vids">
	<?php echo '<iframe src="https://www.youtube.com/embed/videoseries?list=PL4l4gp8IuP2ccIxEvyk-Ao85yTtr8Z-hS&autoplay=0&showinfo=0"></iframe>'; ?>
</div>

<div id="news">
	<div id="news01">
		<div class="newTitle">
			HÍREK
		</div>
		
		<table id="newContent">
			<?php
				$sxml = simplexml_load_file('http://www.chiponline.hu/rss');
				for ($i = 0; $i <= 3; $i++)
				{
					echo '<tr><td>
						<a class="news" target="_blank" href="'.$sxml->channel->item[$i]->link.'">'.$sxml->channel->item[$i]->title.'</a>
						</td></tr>';
				}
			?>
		</table>
	</div>
	<div id="news02">
		<div class="newTitle">
			ÚJDONSÁGOK
		</div>
		
		<table id="newContent">
			<?php
				for ($i = 0; $i <= 3; $i++)
				{
					echo '<tr><td>
						<a class="news" target="_blank" href="'.$sxml->channel->item[$i]->link.'">'.$sxml->channel->item[$i]->title.'</a>
						</td></tr>';
				}
			?>
		</table>
	</div>
</div>

<div id="footer">
	<div id="footerLeft">
		<img src="images/footerLeft.png" alt="">
	</div>
	<div id="footerMid">
		<img src="images/footerMid.png" alt="">
	</div>
	<div id="footerRight">
		<img src="images/footerRight.png" alt="">
	</div>
</div>

<?php
	require $pages.'footer.php';
?>
</div>
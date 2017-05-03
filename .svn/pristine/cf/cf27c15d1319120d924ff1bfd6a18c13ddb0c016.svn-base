<head>
	<meta charset="iso-8559-1">
</head>

<?php

$file = "file.txt";
$str = file_get_contents($file, true);

list(,$str) = explode('[any] => <valasz', $str, 2);

$xml = simplexml_load_string('<valasz'.$str);

echo '<pre>';
print_r($xml);
echo '</pre>';



?>
<?php
    $file = "asd.xml";
    ini_set('memory_limit', '500M');
    ini_set('max_execution_time','300');

    $authcode = "23C2A04A-915C-4E13-A1C3-5198436E9FD5";
    $client = new SoapClient('http://www.expert.hu/services/vision.asmx?WSDL',array("trace" => 1,"exceptions" => 0));
    $result = $client->GetCikkekAuth(array('web_update'=>'2017-04-10-10:00', 'authcode'=>$authcode));
    print_r($result);

    $Json = json_encode(simplexml_load_string($result));
    file_put_contents($file,$Json);

    $myfile = fopen($file, "w") or die("Unable to open file!");
    fwrite($myfile, $result);
    fclose($myfile);

    $resultXml = file_get_contents($file, true);
	$xml = simplexml_load_string($resultXml);

	echo '<pre>';
	print_r($xml);
	echo '</pre>';
?>
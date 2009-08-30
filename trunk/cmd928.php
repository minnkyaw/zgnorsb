<?php
$time_start = microtime(true);
// get contents of a file into a string
$filename = $argv[1];
echo "Reading... ".$argv[1]."\n";
$handle = fopen($filename, "r");
$d= fread($handle, filesize($filename));
fclose($handle);
echo "Completd Read Content...\n";
$myFile = "zawgyi2new.ini";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
fclose($fh);

$theData=str_replace("-","",$theData);
$m=split("\n",$theData);
echo "Converting...\n";
foreach ($m as $x)
{
	$k=split("	",$x);
	if(strripos($d,$k[1])!=false) 	$d=str_replace($k[1],$k[0],$d);
}

$j=0;
	$ka_ah="(က|ခ|ဂ|ဃ|င|စ|ဆ|ဇ|ဈ|ဉ|ည|ဋ|႗|ဥ|ဍ|ဎ|ဏ|တ|ထ|ဒ|ဓ|န|ႏ|ပ|ဖ|ဗ|ဘ|မ|ယ|ရ|႐|လ|ဝ|သ|ႆ|ဟ|ဠ|႒|ဧ|အ|႑|၏|ဩ|၍|၎|၌)";

	$low_char="ၤ|ၠ|ၡ|ၢ|ၣ|ၥ|ၦ|ၧ|ၬ|ၭ|ၨ|ၰ|ၱ|ၳ|ၲ|ၳ|ၴ|ၵ|ၶ|ၷ|ၸ|ၹ|ၺ|ၻ|ၼ|ႅ|႓|႖";
	$pattern[$j]="/ဳ/";
	$replacement[$j] ="ု";
	$j=$j+1;

	$pattern[$j]="/ဴ/";
	$replacement[$j] ="ူ";
	$j=$j+1;

	$pattern[$j]="/႐/";
	$replacement[$j] ="ရ";
	$j=$j+1;
	
	$pattern[$j]="/်ႇ/";
	$replacement[$j] ="ွ်";
	$j=$j+1;
	
	$pattern[$j]="/(ၾ)(ခ|ဂ|င|စ|ဇ|ဒ|ဓ|န|ႏ|ပ|ဖ|ဗ|မ|ဝ|ဧ)/";
	$replacement[$j] = 'ျ$2';
	$j=$j+1;

	$pattern[$j]="/(ျ|ၾ)".$ka_ah."ု/";
	$replacement[$j] = '$1$2ဳ';
	$j=$j+1;

	$pattern[$j]="/(ျ|ၾ)".$ka_ah."ူ/";
	$replacement[$j] = '$1$2ဴ';
	$j=$j+1;
	
	$pattern[$j]="/ၽ/";
	$replacement[$j] = '်';
	$j=$j+1;
	
	$pattern[$j]="/ႏ/";
	$replacement[$j] = 'န';
	$j=$j+1;
	
	$pattern[$j]="/န(ု|ူ|ြ|ႊ|ွ)/";
	$replacement[$j] = 'ႏ$1';
	$j=$j+1;
	
	$pattern[$j]="/န(ု".$low_char.")/";
	$replacement[$j] = 'ႏ$1';
	$j=$j+1;
	
	$pattern[$j]="/ႇု/";
	$replacement[$j] = 'ွု';
	$j=$j+1;
	
	$pattern[$j]="/ႇူ/";
	$replacement[$j] ='ႉ';
	$j=$j+1;
	
	$pattern[$j]="/ြႇ/";
	$replacement[$j] = 'ြွ';
	$j=$j+1;
	
	$pattern[$j]="/(ည|င)္႔/";
	$replacement[$j] = '$1့္';
	$j=$j+1;
	
	$pattern[$j]="/(ခ|ဂ|င|စ|ဇ|ဒ|ဓ)ဲ႔/";
	$replacement[$j] = '$1ဲ့';
	$j=$j+1;
	

	$d=preg_replace($pattern, $replacement, $d);

echo "Completd Convert...\n";
$fp = fopen("convert_".$argv[1], 'w');
fwrite($fp, $d);
fclose($fp);
echo "FINSIHED\n";
$time_end = microtime(true);
$time = $time_end - $time_start;
echo "Total ".$time." seconds";



?> 
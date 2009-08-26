<?php
function zawgyi_normalize($string,$cb="|",$syllable=true)
{
	$string=$string." ";
	$string=str_replace("။"," ။",$string);
	$ka_ah="(က|ခ|ဂ|ဃ|င|စ|ဆ|ဇ|ဈ|ဉ|ည|ဋ|ဋဿဋ|ဥ|ဍ|ဎ|ဏ|တ|ထ|ဒ|ဓ|န|န|ပ|ဖ|ဗ|ဘ|မ|ယ|ရ|ရ|လ|ဝ|သ|သဿသ|ဟ|ဠ|ဋဿဌ|ဧ|အ|ဏဿဍ|၏|ဩ|၍|၎|၌)";
	$ka_ah2="(က|ခ|ဂ|ဃ|င|စ|ဆ|ဇ|ဈ|ဉ|ည|ဋ|ဋဿဋ|ဥ|ဍ|ဎ|ဏ|တ|ထ|ဒ|ဓ|န|န|ပ|ဖ|ဗ|ဘ|မ|ယ|ရ|ရ|လ|ဝ|သ|သဿသ|ဟ|ဠ|ဋဿဌ|ဧ|အ|ဏဿဍ|၏|ဩ|၍|၎|၌|ေ|ျ||)";	
	$mypattern="(ံ|ိ|ီ|ဿငိ|ဿငီ|ဿငံ|ိံ|ာ|ါ|ါ္|ု|ူ|ြ|ြွ|ု|ူ|ွု|္|း|ဲ|့|့|်|်|ွ|ဿင|္)";
	$low_char="ဿင|ဿက|ဿခ|ဿဂ|ဿဃ|ဿစ|ဿဆ|ဿဆ|ဿဋ|ဿဌ|ဿဇ|ဿဏ|ဿထ|ဿတ|ဿထ|ဿထ|ဿဒ|ဿဓ|ဿန|ဿပ|ဿဖ|ဿဗ|ဿဘ|ဿမ|ဿလ|ဿဘ|ဿတြ";
	
	
	////Convertor/////
		$d=$string;
		$myFile = "zawgyi2new.ini";
		$fh = fopen($myFile, 'r');
		$theData = fread($fh, filesize($myFile));
		fclose($fh);
		$theData=str_replace("-","",$theData);
		$m=split("\n",$theData);
		foreach ($m as $x)
		{
			$k=split("	",$x);
			if(strripos($d,$k[0])!=false) 	$d=str_replace($k[0],$k[1],$d);
		}
		
		$string=$d;
	///////////////////////
	
	///Normalize/////
	$j=0;
	$pattern[$j]="/(်||ြွ|ိ|ီ|ဲ|ံ|ါ|ာ|္|ု|ူ|့|း)(".$low_char.")/";
	$j=$j+1;
	$pattern[$j]="/(ြ|ွ|ိ|ီ|ဲ|ံ|ါ|ာ|္|ု|ူ|့|း)(်)/";
	$j=$j+1;
	$pattern[$j]="/(ွ|ိ|ီ|ဲ|ံ|ါ|ာ|္|ု|ူ|့|း)(ြ)/";
	$j=$j+1;
	$pattern[$j]="/(ိ|ီ|ဲ|ံ|ါ|ာ|္|ု|ူ|့|း)(ွ)/";
	$j=$j+1;
	$pattern[$j]="/(ီ|ဲ|ံ|ါ|ာ|္|ု|ူ|့|း)(ိ)/";
	$j=$j+1;
	$pattern[$j]="/(ဲ|ံ|ါ|ာ|္|ု|ူ|့|း)(ီ)/";
	$j=$j+1;
	$pattern[$j]="/(ံ|ါ|ာ|္|ု|ူ|့|း)(ဲ)/";
	$j=$j+1;
	$pattern[$j]="/(ါ|ာ|္|ု|ူ|့|း)(ံ)/";
	$j=$j+1;
	$pattern[$j]="/(ာ|္|ု|ူ|့|း)(ါ)/";
	$j=$j+1;
	$pattern[$j]="/(္|ု|ူ|့|း)(ာ)/";
	$j=$j+1;
	$pattern[$j]="/(ု|ူ|့|း)(္)/";
	$j=$j+1;
	$pattern[$j]="/(ူ|့|း)(ု)/";
	$j=$j+1;
	$pattern[$j]="/(့|း)(ူ)/";
	$j=$j+1;
	$pattern[$j]="/(့)(း)/";
	$j=$j+1;
	$pattern[$j]="/(ျ)(ေ)/";

	$string=preg_replace($pattern, "$2$1", $string);
//////////////
	if ($syllable==true)
		{
			/////////////////////////////////////////////////////////////
			/////////////////////// Character Breaking ////////////////////
			////////////////////////////////////////////////////////////
			//$cb="|";//character break
		$j=0;
		
		$pattern[$j]="/(".$low_char.")()/";
		$replacement[$j]="$1".$cb; 
		
		$j=$j+1;
			
		$pattern[$j]="/".$ka_ah."/";
		$replacement[$j]="$1".$cb;
		
		$j=$j+1;
		
		$pattern[$j]="/".$mypattern."/";
		$replacement[$j]="$1".$cb;
		
		$j=$j+1;
		
		$pattern[$j]="/(\\".$cb.")+/";
		$replacement[$j]=$cb;
		
		$j=$j+1;
		
		
		
		$pattern[$j]="/\\".$cb."(".$low_char.")/";
		$replacement[$j]="$1";
		
		$j=$j+1;
		
		$pattern[$j]="/\\".$cb.$ka_ah2."(".$low_char.")/";
		$replacement[$j]="$1$2";
		
		$j=$j+1; 
		
		$pattern[$j]="/\\".$cb."ေ".$ka_ah."+(".$low_char.")/";
		$replacement[$j]="ေ$1$2$3";
		
		$j=$j+1; 
		
		$pattern[$j]="/\\".$cb.$mypattern."/";
		$replacement[$j]="$1";
		
		$j=$j+1;
		
		$pattern[$j]="/\\".$cb."(့|့)/";
		$replacement[$j]="$1";
		
		$j=$j+1;
		
		$pattern[$j]="/\\".$cb."(".$ka_ah."္)+/";
		$replacement[$j]="$2္";
		
		$j=$j+1;
		
		$pattern[$j]="/\\".$cb."".$ka_ah.$mypattern."္/";
		$replacement[$j]="$1$2္";
		
		$j=$j+1;
		
		$pattern[$j]="/".$cb."(".$low_char.")/";
		$replacement[$j]="$1"; 
		
		$j=$j+1;
		
		$string=preg_replace($pattern, $replacement, $string);	
		
		}
		
	$string=str_replace(" ။","။",$string);
	$string = substr($string, 0, -1);  
	$string=stripslashes($string);
	if($syllable==true) $string=$cb.$string;
	return $string;
}
?>
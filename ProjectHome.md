**New Code**
http://github.com/saturngod/ornagai-V2/blob/master/system/libraries/Zawgyi.php


**This svn is old code**

This code for Zawgyi Normalization & Syllable Breaking.

## Download ##
http://zgnorsb.googlecode.com/svn/trunk/

## Demo ##
http://www.saturngod.net/zgnorsb/

## Using in PHP ##

```
<?php
include("normalize.php");

$string=zawgyi_normalize($string);

/*

$cb="|" // you can use with 0 width space for syllable breaking , default is | , optional
$syllable=true // you dont' want to syllable breaking change false, default is true , optional

$string=zawgyi_normalize($string,$cb,$syllable);

/*

?>
```
<?php 
if('cli'!==PHP_SAPI) return;
if(!isset($argv[1])) return;

$fpi=file($argv[1],FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$fpo=fopen($argv[1].".add","a");
foreach ($fpi as $line) {
  $str=$line;
  $str="fciv ".$str." -both";
  fwrite($fpo,$str.PHP_EOL);
}
fclose($fpo);

?>
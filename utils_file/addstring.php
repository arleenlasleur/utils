<?php 
if('cli'!==PHP_SAPI) return;
if(!isset($argv[1])) return;

$fpi=file($argv[1],FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$fpo=fopen($argv[1].".add","a");
foreach ($fpi as $line) {
  $str=$line;

  $before="fciv ";
  $after =" -both | find \"\\\">>".$argv[1].".cmp";

  $str=$before.$str.$after.PHP_EOL;
  fwrite($fpo,$str);
}
fclose($fpo);

?>
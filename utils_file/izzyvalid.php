<?php
/* strict per-string validator, just destroys last comma (do not add [ ] ) */

if('cli'!==PHP_SAPI) return;
if(!isset($argv[1])) return;

$fpi=file($argv[1],FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$fpo=fopen($argv[1].".val","a");
foreach ($fpi as $line) {
  $str=substr($line,0,-1);
  $str=mb_convert_encoding($str,"utf-8");
  $ustr=json_decode($str);
  if($ustr!=null) fwrite($fpo,"  "); else fwrite($fpo,"xx");
  fwrite($fpo,PHP_EOL);
}
fclose($fpo);

?>

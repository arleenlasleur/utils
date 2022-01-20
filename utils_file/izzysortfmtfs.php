<?php   /* diff from default: +fmt_id, +file_size */

if('cli'!==PHP_SAPI) return;
if(!isset($argv[1])) return;
$str=file_get_contents($argv[1]);
if($str===false) return;
$str=mb_convert_encoding($str,utf8,cp866);
$ustr=json_decode($str);

$sstr=Array();
for($i=0;$i<count($ustr);$i++) array_push($sstr,array($ustr[$i][1],$ustr[$i][0],$ustr[$i][2],$ustr[$i][3],$ustr[$i][4],$ustr[$i][5]));

asort($sstr);

$fp=fopen($argv[1].".sort","a");
fwrite($fp,"[");
$i=0;
foreach($sstr as $key=>$val) {
  $tstr="[\"".$sstr[$key][1]."\","
  ."\"".$sstr[$key][0]."\","
  ."\"".$sstr[$key][2]."\","
  ."\"".mb_convert_encoding($sstr[$key][3],cp866)."\","
  ."\"".$sstr[$key][4]."\","
  ."\"".$sstr[$key][5]."\"]";
  if($i<count($sstr)-1) $tstr.=",".PHP_EOL;
  $i++;
  fwrite($fp,$tstr);
}
fwrite($fp,"]");
fclose($fp);

?>

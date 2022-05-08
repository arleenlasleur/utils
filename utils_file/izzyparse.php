<?php
if('cli'!==PHP_SAPI) return;
if(!isset($argv[1])) return;
$str=file_get_contents($argv[1]);
if($str===false) return;
$ustr=json_decode($str);

$tstr="[\"".str_replace(".info.json","",$argv[1])."\",\""
     .mb_convert_encoding($ustr->upload_date,"cp866","auto")."\",\""
  //   .mb_convert_encoding($ustr->channel_id,"cp866","auto")."\",\""     // for YTId2CId
     .format_sec($ustr->duration)."\",\""
     .mb_convert_encoding($ustr->title,"cp866","auto")."\"],".PHP_EOL;

$fp=fopen('izzy.json','a');
fwrite($fp,$tstr);
fclose($fp);

function format_sec($t){ return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60); }
?>

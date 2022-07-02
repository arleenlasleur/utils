<?php
if('cli'!==PHP_SAPI) return;
if(!isset($argv[1])) return;

$fpi=file($argv[1],FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$reset_trk=false;
$total_trk=0;

foreach ($fpi as $line){

  if(strpos($line,"#EXTM3U")!==false) continue;
  $pos_tl_sta=strpos($line,"#EXTINF:");
  $pos_tl_end=strpos($line,",",$pos_tl_sta);
  $pos_tn_sta=strpos($line,":chapter");

  if($pos_tl_sta!==false){                          // handle first line
    $pos_tl_sta+=8;       // kill m3u head
    $trk_len=substr($line,$pos_tl_sta,$pos_tl_end-$pos_tl_sta);
    $pos_tl_end+=10;      // kill compilation name
    $trk_name=substr($line,$pos_tl_end+1);
  }

  if($pos_tn_sta!==false){                          // handle second line
    $pos_tn_sta+=8;
    $trk_num=substr($line,$pos_tn_sta+1);
    $trk_num+=1;
    if($trk_num<10) $trk_num="0".$trk_num;  // lz
    $reset_trk=true;
  }

  if($reset_trk){                                   // found all, output
    $reset_trk=false;
    echo "  TRACK ".$trk_num." AUDIO".PHP_EOL;
    echo "    INDEX 01 ".fmt_trk_time($total_trk).PHP_EOL;
    echo "    TITLE \"".$trk_name."\"".PHP_EOL;
    $total_trk+=$trk_len;
  }
}

function fmt_trk_time($secs){
  $fmt_min=intval($secs/60);
  $fmt_sec=$secs-($fmt_min*60);
  if($fmt_min<10) $fmt_min="0".$fmt_min;
  if($fmt_sec<10) $fmt_sec="0".$fmt_sec;
  return $fmt_min.":".$fmt_sec.":00";
}

?>
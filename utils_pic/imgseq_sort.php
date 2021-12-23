<?php
if(PHP_SAPI!=='cli') return;
if(!isset($argv[1])){
  echo "call: ".$argv[0]." <infile>".PHP_EOL;
  echo "outfile name prefix - new_, overwritten.".PHP_EOL;
  return;
}
$f=fopen($argv[1], "r");
$fo=fopen("new_".$argv[1], "w");
$i=0;
if($f){
  while(($str = fgets($f, 40))!==false){
    $i++;
    $str=str_replace("\r\n", '', $str);
    fputs($fo,"ren ".$str." ".lz($i).".jpg".PHP_EOL);
  }
  fclose($f);
}
fclose($fo);

function lz($i){
  global $i;
  if ($i<10) return "00".$i;
   else if ($i<100) return "0".$i;
   else return $i;
}
?>
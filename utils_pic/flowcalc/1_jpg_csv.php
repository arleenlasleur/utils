<?php
$path=".";
if(isset($argv[1])){
 $path=$argv[1];
 if(substr($path,-1)=="\\") $path=substr($path,0,-1);
}

$files=scandir($path);
$num_files=count($files)-2;

$fp=fopen("_take_".date("Y-m-d_H-i-s").".csv","w");

for($i=0;$i<$num_files;$i++){
  $fname=lz($i).".jpg";
  if(file_exists($fname)) fwrite($fp,filectime($fname).PHP_EOL);
}
fclose($fp);

function lz($n){
  $s="";
  if($n<10)      $s.="0";
  if($n<100)     $s.="0";
  if($n<1000)    $s.="0";
  if($n<10000)   $s.="0";
  if($n<100000)  $s.="0";
  if($n<1000000) $s.="0";
  $s.=$n;
  return $s;
}
?>
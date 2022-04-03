<?php    // for multiple files written on single date
         // filename template: yyyy-mm-dd*.json

if('cli'!==PHP_SAPI) return;
if(!isset($argv[1])) return;

$fname=$argv[1];
$fname_o=substr($fname,0,10).".json";

if(file_exists($fname)) $data=json_decode(file_get_contents($fname));
if(count($data)<1440){
  echo $fname.": invalid.";
  return;
}

if(file_exists($fname_o)){
  $data_o=json_decode(file_get_contents($fname_o));
  if(count($data_o)<1440){
    echo $fname_o.": invalid.";
    return;
  }else{
    echo "file fond".PHP_EOL;
    for($i=0;$i<1440;$i++) if($data[$i]==1) $data_o[$i]=1;
    file_put_contents($fname_o,json_encode($data_o),LOCK_EX);
  }
}else{
  file_put_contents($fname_o,json_encode($data),LOCK_EX);
}

?>

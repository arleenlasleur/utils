<?php    

if('cli'!==PHP_SAPI) return;
if(!isset($argv[1])) return;
$ena_unique_name=true;
if( isset($argv[2]) && $argv[2]=="/x") $ena_unique_name=false;

$first=true;
$workmins;

$fpi=file($argv[1],FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($fpi as $line){
  $fct=intval($line);
  $fct+=(6*60*60);
  if($first){
    $first=false;
    $workmins=array_fill(0,1440,0);
    $y= date ("Y", $fct);
    $m= date ("m", $fct);
    $d= date ("d", $fct);
    $nfile=$y."-".$m."-".$d.".json";                        // new file name
    if($ena_unique_name) $nfile=$argv[1]."_".$nfile;
    $tbegin=mktime(0,0,0,$m,$d,$y);
  }
  $arrpos=intval(($fct-$tbegin)/60);
  if($arrpos<1440) $workmins[$arrpos]=1;

  if($fct>$tbegin+86400) $first=true;                       // prod another file
  file_put_contents($nfile,json_encode($workmins),LOCK_EX); // dump array
}
?>

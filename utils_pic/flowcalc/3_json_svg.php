<?php
if('cli'!==PHP_SAPI) return;

// todo command-line switch "firstdate", for generate all months' days, even if empty. 29feb=gray.

$path=".";
$files=scandir($path);
foreach($files as $key=>$name) if(strpos($name,".json")===false) unset($files[$key]);  // kill shit
$files=array_values($files);  // reindex
$nsvg=str_replace(".json",".svg",$files[0]);

$markcolor="#0000ff";
if(isset($argv[1])) switch($argv[1]){
 case "1": $markcolor="#000080"; break;
 case "2": $markcolor="#0000ff"; break;
 case "3": $markcolor="#800000"; break;
 case "4": $markcolor="#ff0000"; break;
 case "5": $markcolor="#808000"; break;
 case "6": $markcolor="#008080"; break;
 case "7": $markcolor="#803300"; break;
 case "8": $markcolor="#6c5353"; break;
 case "9": $markcolor="#5a2ca0"; break;
 case "0": $markcolor="#3771c8"; break;
}

$fp=fopen($nsvg,"w");

/* head */
fwrite($fp,"<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"no\"?>
<svg width=\"210mm\" height=\"297mm\" viewBox=\"0 0 210 297\" version=\"1.1\" id=\"svg1\">
  <defs id=\"defs10\" />
  <sodipodi:namedview id=\"base\" pagecolor=\"#a6a4b8\" bordercolor=\"#262633\" borderopacity=\"1\"
     inkscape:document-units=\"mm\" inkscape:current-layer=\"layer1\" showgrid=\"false\" />
  <g inkscape:label=\"Layer 1\" inkscape:groupmode=\"layer\" id=\"layer1\">".PHP_EOL);

/* initial */
$nfile=0;
$id=0;

foreach($files as $fname){
  if(file_exists($fname)) $data=json_decode(file_get_contents($fname));
  if(count($data)<1440){
    echo $fname.": invalid.";
    return;
  }

  /* per-file */
  $last=0;
  $id++;
  fwrite($fp,"    <rect id=\"rect".$id."\" style=\"opacity:1;fill:#ffffff;\" width=\"144\" height=\"2\" x=\"0\" y=\"".
    ($nfile*4)."\" />".PHP_EOL);
  fwrite($fp,"    <text id=\"text".$id."\" style=\"font-size:3;font-family:'Lucida Console';fill:#000000;\" x=\"-20\" y=\"".
    (($nfile*4)+2)."\">".str_replace(".json","",$fname)."</text>".PHP_EOL);
  /* per-period */
  for($i=0;$i<count($data);$i++){
    $curr=$data[$i];
    if($curr!=$last){  // level changed
      $ocl=$curr & 1;  // what it was
      if($ocl){
        $id++;
        $ocb=$i;       // begin
      }else{
        $oce=$i;       // end
        $xp=$ocb/10;
        $wi=($oce-$ocb)/10;
        fwrite($fp,"    <rect id=\"rect".$id."\" style=\"opacity:1;fill:".$markcolor.";\" width=\"".$wi
          ."\" height=\"2\" x=\"".$xp."\" y=\"".($nfile*4)."\" />".PHP_EOL);
      }
      $last=$curr;
    }
  }
  $nfile++;
}

/* terminator */
fwrite($fp,"  </g>".PHP_EOL."</svg>".PHP_EOL);
fclose($fp);
?>

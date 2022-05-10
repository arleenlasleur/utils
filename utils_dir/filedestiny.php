<?php //  File destiny tracer. 0.1 (c) 2022 Arleen Lasleur
// input file syntax:  md5 sha1 fullpath (can be made with dir /on /b /s /a-d>files.lst, then fciv -both each file). eg:
// 4f2b9ba9ca1229c2c4fec4a2ab9c7e6a bd0c037b6dcc2f568dd5f56af173e34346cfb90e d:\wanted-install\install\audio\savihostnkx64.zip
// file should not contain quotes

if("cli"!==PHP_SAPI) return;
$ok_cli=true;
if(!isset($argv[1])) $ok_cli=false;
if(!isset($argv[2])) $ok_cli=false;
$ena_diffmon=in_array("/hm",$argv);

if(!$ok_cli){
  echo "Call: filedestiny <old.lst> <new.lst> [/i]".PHP_EOL;
  echo "      (outputs to stdout)".PHP_EOL;
  echo "      /i - monitor hashes of non-same files.".PHP_EOL;
  return;
}

$f_in_old=file($argv[1],FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$f_in_new=file($argv[2],FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$old_data=array();
$new_data=array();
foreach ($f_in_old as $line) {                  // suck old filetable to memory
  $old_hash=substr($line,0,73);
  $old_path=substr($line,74);
  $old_name=substr($line,strrpos($line,"\\")+1);
  $old_killflag=false;
  array_push($old_data,array($old_hash,$old_path,$old_name,$old_killflag));
}
foreach ($f_in_new as $line) {                  // new filetable
  $new_hash=substr($line,0,73);
  $new_path=substr($line,74);
  $new_name=substr($line,strrpos($line,"\\")+1);
  $new_killflag=false;
  array_push($new_data,array($new_hash,$new_path,$new_name,$new_killflag));
}

for($i=0;$i<count($old_data);$i++){
  $old_hashes=$old_data[$i][0];
  $found=-1;
  $newpath="";
  $new_hashes=  "unset";                   // mbshit debug
  for($j=0;$j<count($new_data);$j++){
    $new_hashes_mb=$new_data[$j][0];
    $new_hashes="skipped";
    if($new_data[$j][3]) continue;
    $new_hashes="unknown";
    if($new_data[$j][2] == $old_data[$i][2]){
    $new_hashes=$new_hashes_mb;
      $found=$j;
      $old_data[$i][3]=true;                    // do not search this entry again
      break;
    }
  }
      /* reset flags */                         $res_bitfield_doa ="         ";
                                                $res_bitfield_altd="         ";
                                                $res_bitfield_movd="         ";
                                                $res_bitfield_intc="         ";
  if($found==-1){
                                                $res_bitfield_doa ="deleted  ";
  }else{
    $newpath=$new_data[$found][1];
    $intact=true;
    if($new_data[$found][0]!=$old_data[$i][0]){ $res_bitfield_altd="altered  "; $intact=false; }
    if($new_data[$found][1]!=$old_data[$i][1]){ $res_bitfield_movd="moved    "; $intact=false; }
    if($intact)                                 $res_bitfield_intc="intact   ";
    $new_data[$found][3]=true;                  // found entry, so exclude it
    unset($new_data[$found]);                   // 
    $new_data=array_values($new_data);          // reindex
  }
  $res=$res_bitfield_intc.$res_bitfield_altd.$res_bitfield_movd.$res_bitfield_doa;
  echo $res.$old_data[$i][1].PHP_EOL;           // show verdict
  if($res_bitfield_movd=="moved    ") // where?
    echo "                   >--to-->         ".$newpath.PHP_EOL;
  if(!$intact && $ena_diffmon){
    echo "old=".$old_hashes.PHP_EOL;
    echo "new=".$new_hashes.PHP_EOL;
  }
}

$k=count($old_data);                            // store length due to it will decrease and cycle fails
for($i=0;$i<$k;$i++){
  if($old_data[$i][3])   unset($old_data[$i]);  // kill already found entries
}
$old_data=array_values($old_data);              // reindex

  $res_bitfield_intc="         ";               // reset first 3 flags
  $res_bitfield_altd="         ";
  $res_bitfield_movd="         ";
for($k=0;$k<count($new_data);$k++){
  $res_bitfield_doa ="added    ";               // instead of deleted
  $res=$res_bitfield_intc.$res_bitfield_altd.$res_bitfield_movd.$res_bitfield_doa;
  echo $res.$new_data[$k][1].PHP_EOL;           // show verdict
}
?>

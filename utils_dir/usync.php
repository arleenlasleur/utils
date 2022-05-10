<?php /* Unreal Engine component file syncer v. 0.2, (c) Arleen Lasleur 2021
         System requrements: PHP 5.2, 7za.dll, 7za.exe, 7zxa.dll living in %path%
         call_file.bat: cd /d %~dp0 && call q php E:\utils\utils_dir\usync.php %1  */

if("cli"!==PHP_SAPI) return;                                  // do not execute in browser
if(!isset($argv[1])){
  echo "Call: sync <cmd>".PHP_EOL
  ." /e - emit backup (compare existing files to hashtable)".PHP_EOL
  ."      (unpack archive on syncdata source to absorb it)".PHP_EOL
  ." /i - make initial hashtable".PHP_EOL
  ." /c - enable contents comparsion (do md5 on same size files)".PHP_EOL;
  return;
}

$argv[1]=strtolower($argv[1]);                                // mode
if(isset($argv[2])) $argv[2]=strtolower($argv[2]);
$ena_emit   =in_array("/e",$argv);
$ena_init_ht=in_array("/i",$argv);
$ena_cnt_cmp=in_array("/c",$argv);

$basepath ="";                                                // cfg
//$basepath="G:\\Games\\U227j\\";
$ht_local ="syncdata_local.json";
$ht_remote="syncdata.json";
$filetable=Array();
include_mask("system\\*.exe");                                // build filelist
exclude_file("gamespyinstaller220std.exe");
exclude_file("runsetup.exe");
exclude_file("setup.exe");
exclude_file("testapp.exe");
include_mask("system\\*.u");
include_mask("system\\*.dll");
include_mask("system\\*.int");
include_mask("textures\\*.utx");
include_mask("music\\*.umx");
include_mask("maps\\*.unr");

if($ena_init_ht){
  foreach ($filetable as $index=>$entry){
    echo $entry[0].PHP_EOL;
    $filetable[$index][1]=filesize($basepath.$entry[0]);
    $filetable[$index][2]=md5_file($basepath.$entry[0]);
  }
  file_put_contents($ht_local,
    // EOL delimited                          // without initial keys
    str_replace("],","],".PHP_EOL,json_encode(array_values($filetable))),LOCK_EX);
  echo PHP_EOL."Note: files sorted in filesystem entries order (Ctrl+F7 in FAR panels).".PHP_EOL;
  return;
}

if($ena_emit){
  if(!file_exists($ht_remote)){
    echo "Hashtable file is absent. Execute sync /i on target and rename file to ".$ht_remote.PHP_EOL;
    return;
  }
  $filetable_remote=json_decode(file_get_contents($ht_remote));
  foreach ($filetable as $index=>$entry){
    $i=search_file($filetable_remote,$basepath.$entry[0]);
    echo str_pad($basepath.$entry[0],95," ");
    if($i!=-1){
      echo "+";
      $ok_exclude=($filetable_remote[$i][1]==filesize($basepath.$entry[0]));
      $ok_match=  ($filetable_remote[$i][2]==md5_file($basepath.$entry[0])) || !$ena_cnt_cmp;
      if($ok_exclude && $ok_match){
        unset($filetable[$index]);
        echo " x";
      }
      echo PHP_EOL;
    }
  }
  if(count($filetable)==0){
    echo "All files seems to be identical, nothing to backup.".PHP_EOL;
    return;
  }
  $fp=fopen("sync.lst","w");
  foreach ($filetable as $fileentry) fwrite($fp,$fileentry[0].PHP_EOL);
  fclose($fp);
  $fp=fopen("sync.bat","w");
  fwrite($fp,"7za a -t7z sync.7z @sync.lst -mx7 -m0=LZMA2".PHP_EOL);
  fwrite($fp,"del sync.lst".PHP_EOL);
  fwrite($fp,"del sync.bat".PHP_EOL);
  fclose($fp);
  echo "Note: spawning process causes false positive av alerts. Launch sync.bat manually.".PHP_EOL;
  return;
}

function include_mask($mask){
  global $filetable,$basepath;
  foreach (glob($basepath.$mask) as $filename)
   array_push($filetable,array (str_replace($basepath,"",$filename),0,""));        // ["path",size,"md5"]
}
function exclude_file($name){
  global $filetable;
  $i=search_file($filetable,$name);
  if($i!=-1) unset($filetable[$i]);
}
function search_file($where,$what){
  $i=-1;
  foreach($where as $index=>$entry) if(stripos($entry[0],$what)!==false) $i=$index;
  return $i;
}
?>
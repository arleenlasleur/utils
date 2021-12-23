<?php
  $str=file_get_contents($argv[1]);
  $ftarg=$argv[2];
  $fp=fopen($ftarg,'w');
  fwrite($fp,base64_decode($str));
  fclose($fp);
?>
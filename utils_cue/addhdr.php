<?
if('cli'!==PHP_SAPI) return;
if(!isset($argv[1])) return;
  
$names=array(
"02"=>"OMVTM02 2018 jun-aeje_7oLCQk.m4a",
"03"=>"OMVTM03 2018 jul-XumnEHC-Hc4.m4a",
"04"=>"OMVTM04 2018 aug-S_VEyP0FUTY.m4a",
"06"=>"OMVTM06 2018 oct-mJb6KACNk4A.m4a",
"07"=>"OMVTM07 2018 nov-6KzzxqSH6gk.m4a",
"08"=>"OMVTM08 2018 dec-jbEnBX-4U6Q.m4a",
"09"=>"OMVTM09 2019 jan-VNZh2RdqOrc.m4a",
"10"=>"OMVTM10 2019 feb-DO220L0A8Bw.m4a",
"11"=>"OMVTM11 2019 mar-OG6hpWwBHmU.m4a",
"12"=>"OMVTM12 2019 apr-kh7eaJRHf9Y.m4a",
"13"=>"OMVTM13 2019 may-ztfbRneWjM4.m4a",
"14"=>"OMVTM14 2019 jun--ukomxzYJAM.m4a",
"15"=>"OMVTM15 2019 jul-M6qVenVvDEI.m4a",
"16"=>"OMVTM16 2019 aug-L7T3Zy-8IoQ.m4a",
"17"=>"OMVTM17 2019 sep-x6mBxBziG38.m4a",
"18"=>"OMVTM18 2019 oct-Ea6AP0hAvcE.m4a",
"19"=>"OMVTM19 2019 nov-Otv2o7jSgWs.m4a",
"20"=>"OMVTM20 2019 dec--K87EQuDDCY.m4a",
"21"=>"OMVTM21 2020 jan-Tp-FgJMY494.m4a",
"22"=>"OMVTM22 2020 feb-WD7rO6GA-jQ.m4a",
"23"=>"OMVTM23 2020 mar-Ig02pnEhLDY.m4a",
"24"=>"OMVTM24 2020 apr-Usho7fnXdRs.m4a",
"25"=>"OMVTM25 2020 may-Eh6XRbJY46I.m4a",
"26"=>"OMVTM26 2020 jun-FikbE47dJZc.m4a",
"27"=>"OMVTM27 2020 jul-WPvu7_9l-W8.m4a",
"28"=>"OMVTM28 2020 aug-oqm9GFLpBHY.m4a",
"29"=>"OMVTM29 2020 sep-KV-vHqJxqRw.m4a",
"30"=>"OMVTM30 2020 oct-ZP7uABiAQz4.m4a",
"31"=>"OMVTM31 2020 nov-k75dcXIKCKQ.m4a",
"32"=>"OMVTM32 2020 dec-yUByl5bdwwI.m4a",
"33"=>"OMVTM33 2021 jan-uWjbKdyRFoo.m4a",
"34"=>"OMVTM34 2021 feb-QHK15PjCEz8.m4a",
"35"=>"OMVTM35 2021 mar-sXPsGqTJy9g.m4a",
"36"=>"OMVTM36 2021 apr-dQg_o1YNUsU.m4a",
"37"=>"OMVTM37 2021 may-iEWI3iBNsTg.m4a",
"38"=>"OMVTM38 2021 jun-kqcTsstlnxk.m4a",
"39"=>"OMVTM39 2021 jul-hqGjJqi16-A.m4a",
"40"=>"OMVTM40 2021 aug-LUw0fCQnidI.m4a",
"41"=>"OMVTM41 2021 sep-r_cz5W7qDUs.m4a",
"42"=>"OMVTM42 2021 oct-gESHurOPl6Q.m4a",
"43"=>"OMVTM43 2021 nov-ES6C6044E-8.m4a",
"44"=>"OMVTM44 2021 dec-8ZNsOFbgbbk.m4a",
"45"=>"OMVTM45 2022 jan-ufjeQTtZ17M.m4a",
"46"=>"OMVTM46 2022 feb-coPQb3fIcJk.m4a",
"47"=>"OMVTM47 2022 mar-Z267B4Dkxfw.m4a",
"48"=>"OMVTM48 2022 apr-zUY_eCp3p4U.m4a"
);

echo "PERFORMER \"".substr($names[$argv[1]],0,7)." (".substr($names[$argv[1]],17,11).")\"".PHP_EOL;
echo "FILE \"".$names[$argv[1]]."\" M4A".PHP_EOL;

?>
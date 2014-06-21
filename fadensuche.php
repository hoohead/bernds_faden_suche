<?php
$faden = array();
$forum = $argv[1];
$suchenach = $argv[2];

for($y=0;$y<14;$y++) {
    seitensuche("http://krautchan.net/".$forum."/".$y.".html");
}

echo count($faden)." Faden geladen, starte Fadendurchsuchung ...\n";
for ($z=0;$z<count($faden);$z++) {
    echo "Faden: ".($z+1)."\n";
    suche_im_faden("http://krautchan.net".$faden[$z], $suchenach);
}



function seitensuche($forenseite) {
    global $faden;
    $source = file_get_contents($forenseite);
    preg_match_all ('/(<a href=\")(.*?)(\">Antworten<)/i',  $source, $matches);
    for ($i=0;$i<count($matches[2]);$i++) {
        $faden[] = $matches[2][$i];   
    }   
}

function suche_im_faden($fadenurl, $suchenach) {
    $source = file_get_contents($fadenurl);
    if(preg_match("/".strtolower($suchenach)."/",strtolower($source))) {
        echo "gefunden -> ".$fadenurl."\n";
    }
}

//Nutze php fadensuche.php ForumID Suchstring
//php fadensuche.php b "Axel Stoll"

?>

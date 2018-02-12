<?php

require('inc.php');

$icerik = new Icerik($_GET);
$sorgu = $icerik->icerikListele();
$ayar  = ayarlar();
include($icerik->getDosya());
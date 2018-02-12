<?php

require('inc.php');

$icerik = new Icerik($_GET);
$sorgu = $icerik->icerikListele();
include($icerik->getDosya());
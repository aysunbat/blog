<?php
function ayarlar()
{
	global $db;
	$don = array();
	$sorgu = $db->get_results('SELECT * FROM ayar');
	foreach($sorgu as $s)
	{
		$don[$s->ad] = $s->deger;
	}
	return $don;
}
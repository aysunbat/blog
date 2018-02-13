<?php
function onayBekleyenYorumSay()
{
	global $db;
	return $db->get_var('SELECT COUNT(id) FROM yorum WHERE durum=2');
}
function toplamIcerikSay()
{
	global $db;
	return $db->get_var('SELECT COUNT(id) FROM icerik');
}
function toplamKategoriSay()
{
	global $db;
	return $db->get_var('SELECT COUNT(id) FROM kategori');
}
function toplamUyeSay()
{
	global $db;
	return $db->get_var('SELECT COUNT(id) FROM kullanici');
}
function toplamYorumSay()
{
	global $db;
	return $db->get_var('SELECT COUNT(id) FROM yorum');
}
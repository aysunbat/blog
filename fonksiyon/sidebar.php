<?php
function sonIcerikleriGoster($sayi=4)
{
	global $db;
	return $db->get_results('SELECT link,baslik FROM icerik ORDER BY tarih DESC LIMIT '.$sayi);
}
function sonYorumlariGoster($sayi=4)
{
	global $db;
	return $db->get_results('SELECT i.link,i.baslik,y.ad FROM yorum AS y LEFT JOIN icerik AS i ON
							y.icerik=i.id WHERE y.durum=1 ORDER BY y.tarih DESC LIMIT '.$sayi);
}
function populerIcerikleriGoster($sayi=4)
{
	global $db;
	return $db->get_results('SELECT link,baslik,hit FROM icerik ORDER BY hit DESC LIMIT '.$sayi);
}
function kategorileriGoster()
{
	global $db;
	return $db->get_results('SELECT baslik,link FROM kategori ORDER BY baslik ASC');
}
?>
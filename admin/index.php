<?php
require_once('../baglan.php');
/*İnterface ve Sınıflar İnclude Başla*/

#traitler
include('trait/ekle.php');

#interfaceler
include('interface/islem.php');

#siniflar
include('sinif/uye.php');
include('sinif/kategori.php');
/*İnterface ve Sınıflar İnclude Bit*/

$uye = new Uye;

if(empty($_SESSION['giris']))
{	
	$uyeSayisi = $uye->uyeSayisi();
	if($_POST)
	{
		if($uyeSayisi>0)
		{
			$sonuc = $uye->girisYap($_POST);
		}
		else
		{
			$sonuc = $uye->ekle($_POST);	

		}
	}
	if(empty($_SESSION['giris']))
	{
		require('tasarim/giris.php');
		exit;
	}
}
if(isset($_GET['y']))
{
	$y = $_GET['y'];
}
else
{
	$y = '';
}
switch ($y) {
	
	case 'kategori':
		$kategori = new Kategori;
		$yer = 'kategori';
	break;

	default:
		$yer = 'index';
	break;
}

include('tasarim/'.$yer.'.php');
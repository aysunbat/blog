<?php
require_once('../baglan.php');
/*İnterface ve Sınıflar İnclude Başla*/

#traitler
include('trait/ekle.php');

#interfaceler
include('interface/islem.php');

#siniflar
include('sinif/pagination.php');
include('sinif/uye.php');
include('sinif/kategori.php');
include('sinif/icerik.php');
include('sinif/ayar.php');
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
	case 'icerik':
		$icerik = new Icerik;
		include('sinif/upload.php');
		$yer = 'icerik';
	break;
	case 'ayar':
		$ayar = new Ayar;
		$yer  = 'ayar';
	break;
	default:
		$yer = 'index';
	break;
}

include('tasarim/'.$yer.'.php');
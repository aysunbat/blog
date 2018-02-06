<?php
class Uye implements Islem
{
	private $tabloAdi = 'kullanici';
	public function ekle($p)
	{
		global $db;
		$hata = array();
		$sonuc = array();
		if(empty($p['nick']))
		{
			$hata[] = 'Lütfen Nickinizi Girin';
		}
		if(empty($p['sifre']))
		{
			$hata[] = 'Lütfen Şifrenizi Girin';	
		}
		$hatayiSay = count($hata);
		if($hatayiSay==0)
		{
			$nick = $db->escape(strip_tags($p['nick']));
			$sifre = md5(strip_tags($p['sifre']));
			$kullaniciSay = $db->get_var('SELECT COUNT(id) FROM '.$this->tabloAdi.' WHERE nick="'.$nick.'"');
			if($kullaniciSay==0)
			{
				$ekle = $db->query("INSERT INTO ".$this->tabloAdi." (nick,sifre) VALUES ('$nick','$sifre')");
				if($ekle)
				{
					$sonuc[] = true;
					$_SESSION['giris'] = 'OK';
				}	
				else
				{
					$sonuc[] = false;
				}
			}
			else
			{
				$hata[] = 'Böyle bir kullanıcı mevcut.';
				$sonuc[] = false;
				$sonuc[] = $hata;
			}
		}
		else
		{
			$sonuc[] = false;
			$sonuc[] = $hata;	
		}
		return $sonuc;

	}
	public function girisYap($p)
	{
		global $db;
		$hata = array();
		$nick = $db->escape(strip_tags($p['nick']));
		$sifre = md5(strip_tags($p['sifre'])); 
		$sayi = $db->get_var("SELECT COUNT(id) FROM ".$this->tabloAdi." WHERE nick='$nick' AND sifre='$sifre'");
		if($sayi>0)
		{
			$_SESSION['giris'] = 'OK';
			$sonuc[] = true;
		}
		else
		{
			$hata[] = 'Yanlış Kullanıcı Adı veya Şifre';
			$sonuc[] = false;
			$sonuc[] = $hata;
		}
		return $sonuc;

	}
	public function guncelle($p)
	{

	}
	public function listele()
	{

	}
	public function sil($id)
	{

	}

	public function uyeSayisi()
	{
		global $db;
		$say = $db->get_var('SELECT COUNT(id) FROM '.$this->tabloAdi);	
		return $say;
	}

}
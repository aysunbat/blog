<?php
class Uye implements Islem
{
	private $tabloAdi = 'kullanici';
	public $icerikSayisi = 10;
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
					$_SESSION['nick']  = $nick;
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
			$_SESSION['nick']  = $nick;
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
		global $db; 
		if(empty($p['nick'])||empty($p['id']))
		{
			return false;
		}

		$eski = $this->tekListele($p['id']);
		if(empty($p['sifre']))
		{
			$sifre = $eski->sifre;
		}
		else
		{
			$sifre = md5($p['sifre']);
		}
		$nick = $db->escape($p['nick']);
		$id = intval($p['id']);
		$sor = $db->get_var('SELECT COUNT(id) FROM '.$this->tabloAdi.' WHERE nick="'.$nick.'" AND id!='.$id);
		if($sor>0)
		{
			return false;
		}
		$g = $db->query("UPDATE ".$this->tabloAdi." SET nick='$nick',sifre='$sifre' WHERE id=$id");
		if($g)
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
	public function listele()
	{
		global $db;
		if(!empty($_GET['sayfa']))
		{
			$sayfa = $_GET['sayfa'];
		}
		else
		{
			$sayfa = 1;
		}
		
		$limit = ($sayfa-1)*$this->icerikSayisi;
		$sonuc = $db->get_results('SELECT *  FROM '.$this->tabloAdi.' ORDER BY id DESC LIMIT '.$limit.','.$this->icerikSayisi);
		return $sonuc;
	}
	public function sil($id)
	{
		global $db;
		return $db->query('DELETE FROM '.$this->tabloAdi.' WHERE id='.$id);
	}
	public function toplamIcerik()
	{
		global $db;
		$say = $db->get_var('SELECT COUNT(id) FROM '.$this->tabloAdi);
		return  $say;
	}
	public function uyeSayisi()
	{
		global $db;
		$say = $db->get_var('SELECT COUNT(id) FROM '.$this->tabloAdi);	
		return $say;
	}

	public function tekListele($id)
	{
		global $db;
		return $db->get_row('SELECT * FROM '.$this->tabloAdi.' WHERE id='.$id);
	}

}
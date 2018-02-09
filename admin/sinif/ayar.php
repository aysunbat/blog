<?php
class Ayar
{
	
	private $tabloAdi = 'ayar';
	public function ayarDegeriAl($ayarAd)
	{
		global $db;
		if($this->ayarEklenmismi($ayarAd))
		{
			$al = $db->get_row("SELECT deger FROM ".$this->tabloAdi." WHERE ad='$ayarAd'");
			return $al->deger;
		}
		else
		{
			return '';
		}
	}
	public function guncelle($p)
	{
		global  $db;
		foreach($p AS $ad => $deger)
		{
			$deger = $db->escape($deger);
			$ad = $db->escape($ad);
			if($this->ayarEklenmismi($ad))
			{
				$db->query("UPDATE ".$this->tabloAdi." SET deger='$deger' WHERE ad='$ad'");

			}
			else
			{
				$db->query("INSERT INTO ".$this->tabloAdi." (ad,deger) VALUES ('$ad','$deger')");
			}
			
		}
		return true;
	}
	private function ayarEklenmismi($ayarAd)
	{
		global $db;
		$say = $db->get_var("SELECT COUNT(id) FROM ".$this->tabloAdi." WHERE ad='$ayarAd'");
		if($say==0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
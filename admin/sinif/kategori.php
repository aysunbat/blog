<?php
class Kategori implements Islem
{
	private $tabloAdi = 'kategori';
	use Ekle;
	public function ekle($p)
	{
		global $db;
		$baslik = $db->escape(strip_tags($p['ad']));
		if(empty($baslik))
		{
			return false;
		}
		else
		{
			$link = $this->linkKontrol($this->linkYap($baslik));
			$ekle = $db->query("INSERT INTO ".$this->tabloAdi." (baslik,link) VALUES ('$baslik','$link')");
			if($ekle)
			{
				return true;
			}
			else
			{
				return false;
			}
		}	
	}
	public function sil($id)
	{
		global $db;
		if($db->query('DELETE FROM '.$this->tabloAdi.' WHERE id='.$id))
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
		$sonuc = $db->get_results('SELECT * FROM '.$this->tabloAdi.' ORDER BY id DESC');
		return $sonuc;
	}
	public function guncelle($p)
	{
		global $db;
		$baslik = $db->escape(strip_tags($p['ad']));
		$id = intval($p['id']);
		if(empty($baslik) || empty($id))
		{
			return false;
		}
		else
		{
			
			$guncelle = $db->query("UPDATE ".$this->tabloAdi." SET baslik='$baslik' WHERE id=$id");
			if($guncelle)
			{
				return true;
			}
			else
			{
				return false;
			}
		}	
	}

	private function linkKontrol($link)
	{
		global $db;
		$say = $db->get_var("SELECT COUNT(id) FROM ".$this->tabloAdi." WHERE link='$link'");
		if($say==0)
		{
			return $link;
		}
		else
		{
			$sayi = 2;
			while($sayi<100)
			{
				$yeniLink = $link.'-'.$sayi;
				$say = $db->get_var("SELECT COUNT(id) FROM ".$this->tabloAdi." WHERE link='$yeniLink'");	
				if($say==0)
				{
					return $yeniLink;
					break;
				}
				$sayi++;
			}
		}
	}
	public function tekListele($id)
	{
		global $db;
		return $db->get_row('SELECT * FROM '.$this->tabloAdi.' WHERE id='.$id);
	}
}
?>
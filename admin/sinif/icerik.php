<?php
class Icerik implements Islem
{
	use Ekle;
	private $tabloAdi = 'icerik';
	public $icerikSayisi = 10;
	public function ekle($p)
	{
		global $db;
		if(empty($p['ad']))
		{
			return false;
		}
		else
		{
			$baslik = $db->escape(strip_tags($p['ad']));
			$kategori = intval($p['kategori']);
			if(empty($p['durum']))
			{
				$durum = 2;
			}
			else
			{
				$durum = intval($p['durum']);
			}
			$icerik = $db->escape($p['icerik']);
			$link = $this->linkKontrol($this->linkYap($baslik));
			if(!empty($p['resimlink']))
			{
				$resim = $db->escape($p['resimlink']);
			}
			elseif(!empty($_FILES['resimyukle']['tmp_name']))
			{
				$handle = new upload($_FILES['resimyukle']);
				if ($handle->uploaded) {
				  $handle->file_new_name_body   = $link;
				  $handle->allowed = array('image/*');
				  $handle->process('../dosyalar');
				  if ($handle->processed) {
				    $resim = url.'/dosyalar/'.$handle->file_dst_name;
				    $handle->clean();
				  } else {
				  	return false;
				  }
				}
			}
			else
			{
				$resim = '';
			}
			$tarih = time();
			$ekle = $db->query("INSERT INTO ".$this->tabloAdi." (baslik,link,kategori,durum,resim,tarih,metin)
													VALUES ('$baslik','$link','$kategori','$durum','$resim',$tarih,'$icerik')	");
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
		$sil = $db->query('DELETE FROM '.$this->tabloAdi.' WHERE id='.$id);
		if($sil)
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
		/*
			1 = 0,10
			2 = 10,10
			3 = 20,10
			4 = 30,10

			1 = 0,20
			2 = 20,20
			3 = 40,20
		*/
		$limit = ($sayfa-1)*$this->icerikSayisi;
		$sonuc = $db->get_results('SELECT i.*,k.baslik AS kategoriAd FROM '.$this->tabloAdi.' AS i LEFT JOIN kategori AS k ON i.kategori=k.id ORDER BY i.id DESC LIMIT '.$limit.','.$this->icerikSayisi);
		return $sonuc;
	}
	public function toplamIcerik()
	{
		global $db;
		$say = $db->get_var('SELECT COUNT(id) FROM '.$this->tabloAdi);
		return  $say;
	}
	public function guncelle($p)
	{
		global $db;
		if(empty($p['ad']) || empty($p['id']))
		{
			return false;
		}
		else
		{
			$baslik = $db->escape(strip_tags($p['ad']));
			$kategori = intval($p['kategori']);
			if(empty($p['durum']))
			{
				$durum = 2;
			}
			else
			{
				$durum = intval($p['durum']);
			}
			$icerik = $db->escape($p['icerik']);
			
			if(!empty($p['resimlink']))
			{
				$resim = $db->escape($p['resimlink']);
			}
			elseif(!empty($_FILES['resimyukle']['tmp_name']))
			{
				$handle = new upload($_FILES['resimyukle']);
				if ($handle->uploaded) {
				  $handle->file_new_name_body   = $this->linkYap($baslik);
				  $handle->allowed = array('image/*');
				  $handle->process('../dosyalar');
				  if ($handle->processed) {
				    $resim = url.'/dosyalar/'.$handle->file_dst_name;
				    $handle->clean();
				  } else {
				  	return false;
				  }
				}
			}
			else
			{
				$resim = $p['resim'];
			}
			$id = intval($p['id']);

			$guncelle = $db->query("UPDATE ".$this->tabloAdi." SET baslik='$baslik',kategori=$kategori,durum=$durum,resim='$resim',metin='$icerik' WHERE id=$id");
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

	public function kategoriOption($id=0)
	{
		global $db;
		$sonuc = $db->get_results('SELECT id,baslik FROM kategori ORDER BY id DESC');
		$don = '<option value="0">Kategori Seçin</option>';
		foreach($sonuc as $s)
		{
			$don .= '<option value="'.$s->id.'"';
			if($s->id==$id)
			{
				$don .= ' selected="selected"';
			}
			$don .= '>'.$s->baslik.'</option>';
		}

		return $don;
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
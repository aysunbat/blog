<?php
class Icerik implements Islem
{
	use Ekle;
	private $tabloAdi = 'icerik';
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

	}
	public function listele()
	{

	}
	public function guncelle($p)
	{

	}

	public function kategoriOption()
	{
		global $db;
		$sonuc = $db->get_results('SELECT id,baslik FROM kategori ORDER BY id DESC');
		$don = '<option value="0">Kategori Seçin</option>';
		foreach($sonuc as $s)
		{
			$don .= '<option value="'.$s->id.'">'.$s->baslik.'</option>';
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
}
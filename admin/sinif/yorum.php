<?php
class Yorum 
{
	private $tabloAdi = 'yorum';
	public $icerikSayisi = 10;
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
		$sonuc = $db->get_results('SELECT y.*,i.baslik FROM '.$this->tabloAdi.' AS y LEFT JOIN icerik  AS i ON y.icerik=i.id ORDER BY y.id DESC LIMIT '.$limit.','.$this->icerikSayisi);
		return $sonuc;
	}
	public function toplamIcerik()
	{
		global $db;
		$say = $db->get_var('SELECT COUNT(id) FROM '.$this->tabloAdi);
		return  $say;
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
	public function tekListele($id)
	{
		global $db;
		return $db->get_row('SELECT * FROM '.$this->tabloAdi.' WHERE id='.$id);
	}
	public function guncelle($p)
	{
		global $db; 
		if(empty($p['yorum'])||empty($p['ad'])||empty($p['id']))
		{
			return false;
		}
		$yorum = $db->escape($p['yorum']);
		$id = intval($p['id']);
		$ad = $db->escape($p['ad']);
		$mail = $db->escape($p['mail']);
		$durum = intval($p['durum']);
		$g = $db->query("UPDATE ".$this->tabloAdi." SET yorum='$yorum',ad='$ad',mail='$mail',durum=$durum WHERE id=$id");
		if($g)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>
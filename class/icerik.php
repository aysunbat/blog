<?php
class Icerik
{
	private $yer;
	private $dosya;
	private $link;
	private $sayfa;
	private $icerikSayisi;
	private $toplamIcerik;
	public function setYer($y)
	{
		$this->yer = $y;
	}
	public function getYer()
	{
		return $this->yer;
	}
	public function setToplamIcerik($i)
	{
		$this->toplamIcerik = $i;
	}
	public function getToplamIcerik()
	{
		return $this->toplamIcerik;
	}
	public function setDosya($d)
	{
		$this->dosya = $d;
	}
	public function getDosya()
	{
		return $this->dosya;
	}
	public function setLink($l)
	{
		global $db;
		$this->link = $db->escape(strip_tags($l));
	}
	public function getLink()
	{
		return $this->link;
	}
	public function setSayfa($s)
	{
		$this->sayfa = $s;
	}
	public function getSayfa()
	{
		return $this->sayfa;
	}
	public function setIcerikSayisi($s)
	{
		$this->icerikSayisi = $s;
	}
	public function getIcerikSayisi()
	{
		return $this->icerikSayisi;
	}

	public function __construct($g)
	{
		if(isset($g['yer']))
		{
			$this->setYer($g['yer']);
		}
		else
		{
			$this->setYer('index');	
		}
		if(file_exists('tema/'.tema.'/'.$this->getYer().'.php'))
		{
			$this->setDosya('tema/'.tema.'/'.$this->getYer().'.php');	
		}
		else
		{
			$this->setDosya('tema/'.tema.'/index.php');
		}
		if(isset($g['link']))
		{
			$this->setLink($g['link']);
		}
		else
		{
			$this->setLink('');
		}
		if(isset($g['sayfa']))
		{
			if(intval($g['sayfa'])==0)
			{
				$g['sayfa'] = 1;
			}
			$this->setSayfa($g['sayfa']);
		}
		else
		{
			$this->setSayfa(1);
		}
		$this->setIcerikSayisi(10);
	}

	public function icerikListele()
	{
		global $db;
		$yer = $this->getYer();
		$link = $this->getLink();
		if(($yer=='icerik' || $yer=='kategori') && empty($link))
		{
			$yer = 'index';
		}
		$limit = ($this->getSayfa()-1)*$this->getIcerikSayisi();
		switch ($yer) {
			case 'icerik':
				$sorgu = $db->get_results('SELECT * FROM icerik WHERE link="'.$link.'" AND durum=1');
				if(!empty($sorgu))
				{
					$db->query('UPDATE icerik SET hit=hit+1 WHERE id='.$sorgu[0]->id);
				}
				$this->setToplamIcerik(1);
				break;
			case 'kategori':
				$sorgu = $db->get_results('SELECT i.*,k.baslik AS kategoriAd,k.link AS kategoriLink FROM kategori k LEFT JOIN icerik i ON k.id=i.kategori WHERE k.link="'.$link.'" AND i.durum=1 ORDER BY i.id DESC LIMIT '.$limit.', '.$this->getIcerikSayisi());
				$say = $db->get_var('SELECT COUNT(k.id) FROM kategori k LEFT JOIN icerik i ON k.id=i.kategori WHERE k.link="'.$link.'" AND i.durum=1');
				$this->setToplamIcerik($say);
			break;
			case 'arama':
				$arama = $db->escape($_GET['sorgu']);
				$sorgu = $db->get_results('SELECT * FROM  icerik WHERE durum=1 AND (baslik LIKE "%'.$arama.'%" OR metin LIKE "%'.$arama.'%")  ORDER BY id DESC LIMIT '.$limit.', '.$this->getIcerikSayisi());
				$say = $db->get_var('SELECT COUNT(id) FROM  icerik WHERE durum=1 AND (baslik LIKE "%'.$arama.'%" OR metin LIKE "%'.$arama.'%")');
				$this->setToplamIcerik($say);
			break;
			default:
				$sorgu = $db->get_results('SELECT * FROM  icerik WHERE durum=1  ORDER BY id DESC LIMIT '.$limit.', '.$this->getIcerikSayisi());
				$say = $db->get_var('SELECT COUNT(id) FROM  icerik WHERE durum=1');
				$this->setToplamIcerik($say);
				break;
		}
		if(empty($sorgu))
		{
			$this->setDosya('tema/'.tema.'/404.php');
		}
		return $sorgu;
	}

	public function icerikLinki($link)
	{
		return url.'/'.$link.'.html';
	}
	public function yorumSay($id)
	{
		global $db;
		$say = $db->get_var('SELECT COUNT(id) FROM yorum WHERE icerik='.$id.' AND durum=1');
		return $say;
	}
	public function icerigiGoster($metin)
	{
		if($this->getYer()!='icerik')
		{
			return nl2br(substr($metin, 0,200));
		}
		else
		{
			return nl2br($metin);
		}
	}

	public function yorumYap()
	{
		global $db,$ayar;
		if($ayar['yorumdurum']==1 && isset($_POST['isim']))
		{
			$isim = $db->escape(strip_tags($_POST['isim']));
			$mail = $db->escape(strip_tags($_POST['mail']));
			$yorum = $db->escape(strip_tags($_POST['yorum']));
			$id = intval($_POST['id']);
			if(empty($isim)||empty($mail)||empty($yorum)||empty($id))
			{
				return false;
			}
			if($id==0)
			{
				return false;
			}
			if($ayar['yorumonay']==1)
			{
				$durum = 2;
			}
			if($ayar['yorumonay']==2)
			{
				$durum = 1;
			}
			$tarih = time();
			$s = $db->query("INSERT INTO yorum (ad,mail,icerik,tarih,yorum,durum)
									VALUES ('$isim','$mail',$id,$tarih,'$yorum',$durum)");
			if($s)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	public function yorumListele($id)
	{
		global $db;
		$say = $db->get_var('SELECT COUNT(id) FROM yorum WHERE icerik='.$id.' AND durum=1');
		if($say>0)
		{
			$sorgu = $db->get_results('SELECT * FROM yorum WHERE icerik='.$id.' AND durum=1 ORDER BY id DESC');
			return $sorgu;
		}
		else
		{
			return false;
		}
	}
}
?>
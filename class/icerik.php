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
		$this->link = $l;
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
				$this->setToplamIcerik(1);
				break;
			case 'kategori':
				$sorgu = $db->get_results('SELECT i.*,k.baslik AS kategoriAd,k.link AS kategoriLink FROM kategori k LEFT JOIN icerik i ON k.id=i.kategori WHERE k.link="'.$link.'" AND i.durum=1 ORDER BY i.id DESC LIMIT '.$limit.', '.$this->getIcerikSayisi());
				$say = $db->get_var('SELECT COUNT(k.id) FROM kategori k LEFT JOIN icerik i ON k.id=i.kategori WHERE k.link="'.$link.'" AND i.durum=1');
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
}
?>
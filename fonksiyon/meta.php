<?php
function meta($ne='title')
{
	global $icerik,$sorgu,$ayar;	
	$yer = $icerik->getYer();
	switch ($yer) {
		case 'icerik':
			if(!empty($sorgu[0]->baslik))
			{
				$title = $sorgu[0]->baslik.' '.$ayar['title'];
				$desc = $sorgu[0]->baslik.' '.$ayar['description'];
			}
			break;
		case 'kategori':
			if(!empty($sorgu[0]->baslik))
			{
				$title = $sorgu[0]->kategoriAd.' '.$ayar['title'];
				$desc = $sorgu[0]->kategoriAd.' '.$ayar['description'];
				if($icerik->getSayfa()>1)
				{
					$title .= ' '.$icerik->getSayfa();
					$desc .= ' '.$icerik->getSayfa();
				}
			}
			break;
		case 'arama':
			if(!empty($sorgu[0]->baslik))
			{
				$title = $_GET['sorgu'].' Araması '.$ayar['title'];
				$desc = $_GET['sorgu'].' Araması '.$ayar['description'];
				if($icerik->getSayfa()>1)
				{
					$title .= ' '.$icerik->getSayfa();
					$desc .= ' '.$icerik->getSayfa();
				}
			}
			break;
		default:
			$title = $ayar['title'];
			$desc = $ayar['description'];
			if($icerik->getSayfa()>1)
			{
				$title .= ' '.$icerik->getSayfa();
				$desc .= ' '.$icerik->getSayfa();
			}
			break;
	}
	if(!isset($title))
	{
		$title = '404 Bulunamadı '.$ayar['title'];
	}
	if(!isset($desc))
	{
		$desc = '404 Bulunamadı '.$ayar['description'];
	}
	if($ne=='title')
	{
		echo $title;
	}
	elseif($ne=='desc')
	{
		echo $desc;
	}
	else
	{
		echo '';
	}

}

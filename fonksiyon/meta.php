<?php
function meta($ne='title')
{
	global $icerik,$sorgu,$ayar;	
	$yer = $icerik->getYer();
	switch ($yer) {
		case 'icerik':
			$title = $sorgu[0]->baslik.' '.$ayar['title'];
			$desc = $sorgu[0]->baslik.' '.$ayar['description'];
			break;
		case 'kategori':
			$title = $sorgu[0]->kategoriAd.' '.$ayar['title'];
			$desc = $sorgu[0]->kategoriAd.' '.$ayar['description'];
			if($icerik->getSayfa()>1)
			{
				$title .= ' '.$icerik->getSayfa();
				$desc .= ' '.$icerik->getSayfa();
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

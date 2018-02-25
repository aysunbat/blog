<?php include('ust.php');?>
<?php include('yan.php');?>	  
		  
		 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
 	
 	 <!--faq-->
 	<div class="blank">
	

			<div class="blank-page">
				
	        	<form method="post" action="">
	        		<input type="text" class="form-control" name="link" placeholder="http://"><br/>
	        		<div class="radio-inline"><label><input type="radio" name="durum" value="1">Yayında</label></div>
	        		<div class="radio-inline"><label><input type="radio" name="durum" value="2" checked="checked">Taslak</label></div>
	        		<button type="submit">Ekle</button>
	        	</form>

	        	<?php if(isset($_POST['link']))
	        	{
	        		$site = file_get_contents($_POST['link']);
	        		$desen = '!<div class=\'featured-image\' style="background-image: url\(\'(.+?)\'\)">.+?</div>.+?<h1 class=\'excerpt-title\'>.+?<a href=".+?">(.+?)</a>.+?</h1>.+?<div class=\'excerpt-content\'>.+?<article>(.+?)</article>(.+?)</div>!si';
	        		preg_match_all($desen, $site, $eslesme);
	        		$say = count($eslesme[1]);
	        		for($i=0;$i<$say;$i++)
	        		{
	        			$resim = $eslesme[1][$i];
	        			$baslik = $eslesme[2][$i];
	        			$metin = $eslesme[3][$i];
	        			if($icerik->baslikVarmi($baslik))
	        			{
	        				$ic['ad'] = $baslik;
	        				$ic['resimlink'] = $resim;
	        				$ic['icerik'] = $metin;
	        				$ic['durum'] = $_POST['durum'];
	        				$ic['kategori'] = 0;
	        				if($icerik->ekle($ic))
	        				{
	        					echo '<div style="color:green">'.$baslik.' Eklendi</div>';
	        				}
	        			}
	        			else
	        			{
	        				echo '<div style="color:red">'.$baslik.' Daha Önce Eklenmiş</div>';
	        			}
	        		}
	        	}
	        	?>
	        </div>
	       </div>
	<?php include('alt.php');?>

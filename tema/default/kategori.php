<?php require('inc/ust.php');?>
<div class="content">
	 <div class="container">
		 <div class="content-grids">
			 <div class="col-md-8 content-main">
				 <div class="content-grid">
				 	Kategori: <?php echo $sorgu[0]->kategoriAd;?>
				 <?php foreach ($sorgu as $s):?>
				 				 
					 <div class="content-grid-info">
					 	<?php if(!empty($s->resim)):?>
						 <img src="<?php echo $s->resim;?>" style="max-width: 650px;" alt="<?php echo $s->baslik;?>"/>
						<?php endif;?>
						 <div class="post-info">
						 <h4><a href="<?php echo $icerik->icerikLinki($s->link);?>"><?php echo $s->baslik;?></a>  <?php echo date('d/m/Y H:i',$s->tarih);?> / <?php echo $icerik->yorumSay($s->id);?> Yorum</h4>
						 <p><?php echo $icerik->icerigiGoster($s->metin);?></p>
						 
						 <a href="<?php echo $icerik->icerikLinki($s->link);?>"><span></span>Devamını Oku</a>
						
						 </div>
					 </div>
				
					<?php endforeach;?> 
					<?php sayfalama($icerik->getToplamIcerik(),$icerik->getIcerikSayisi(),$icerik->getSayfa(),url.'/kategori/'.$sorgu[0]->kategoriLink.'/sayfa/(:num)');?> 
				 </div>
			  </div>
			<?php require('inc/yan.php');?>
			  <div class="clearfix"></div>
		  </div>
	  </div>
</div>
<!---->
<?php require('inc/alt.php');?>
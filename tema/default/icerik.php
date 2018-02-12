<?php require('inc/ust.php');?>
<div class="single">
	 <div class="container">
		  <div class="col-md-8 single-main">				 
			  <div class="single-grid">
			  	<?php foreach($sorgu as $s):?>
					<?php if(!empty($s->resim)):?>
						 <img src="<?php echo $s->resim;?>" style="max-width: 650px;" alt="<?php echo $s->baslik;?>"/>
						<?php endif;?>						 					 
					<p><?php echo $icerik->icerigiGoster($s->metin);?></p>
					<?php endforeach;?>
			  </div>
			 <?php 
			 	$yorumlar = $icerik->yorumListele($sorgu[0]->id);
			 	if($yorumlar):?>	
			 		<?php foreach ($yorumlar as $y ):?>
			 		<ul class="comment-list">
			 		
				 				
				  		   <h5 class="post-author_head">Yazdı:<?php echo $y->ad;?> - <?php echo date('d/m/Y H:i',$y->tarih);?></h5>
				  		   <li>
				  		   <div class="desc">
				  		   <p>
				  		   	<?php echo $y->yorum;?>
				  		   </p>
				  		   </div>
				  		   <div class="clearfix"></div>
				  		   </li>
			  		
		  	  		</ul>
		  	  		<?php endforeach; ?>
		  	  <?php endif;?>
		  	  <?php if($ayar['yorumdurum']==1):
		  	  	if($icerik->yorumYap())
		  	  	{
		  	  		?>
		  	  			Yorumunuz Başarıyla Eklendi
		  	  		<?php
		  	  	}
		  	  ?>
			  <div class="content-form">
					 <h3>Yorum Yap</h3>
					<form method="post" action="">
						<input type="text" placeholder="İsim" name="isim" required/>
						<input type="text" placeholder="Email" name="mail" required/>
						
						<textarea placeholder="Yorumunuz" name="yorum" required></textarea>
						<input type="hidden" name="id" value="<?php echo $sorgu[0]->id;?>"/>
						<input type="submit" value="Gönder"/>
				   </form>
						 </div>
			<?php endif;?>
		  </div>

			 <?php require('inc/yan.php');?>
			  <div class="clearfix"></div>
		  </div>
	  </div>
</div>
<!---->
<?php require('inc/alt.php');?>
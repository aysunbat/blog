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
			 <?php /*<ul class="comment-list">
		  		   <h5 class="post-author_head">Written by <a href="#" title="Posts by admin" rel="author">admin</a></h5>
		  		   <li><img src="images/avatar.png" class="img-responsive" alt="">
		  		   <div class="desc">
		  		   <p>View all posts by: <a href="#" title="Posts by admin" rel="author">admin</a></p>
		  		   </div>
		  		   <div class="clearfix"></div>
		  		   </li>
		  	  </ul>*/ ?>
			  <div class="content-form">
					 <h3>Yorum Yap</h3>
					<form>
						<input type="text" placeholder="İsim" name="isim" required/>
						<input type="text" placeholder="Email" name="mail" required/>
						
						<textarea placeholder="Yorumunuz" name="yorum"></textarea>
						<input type="submit" value="Gönder"/>
				   </form>
						 </div>
		  </div>

			 <?php require('inc/yan.php');?>
			  <div class="clearfix"></div>
		  </div>
	  </div>
</div>
<!---->
<?php require('inc/alt.php');?>
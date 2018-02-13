  <div class="col-md-4 content-right">
				 <div class="recent">
					 <h3>Son Yazılar</h3>
					 <ul>
					 <?php $sorgu = sonIcerikleriGoster();
					 foreach ($sorgu as $s ):
					 ?>	
					 <li><a href="<?php echo $icerik->icerikLinki($s->link);?>"><?php echo $s->baslik;?></a></li>
					 <?php endforeach;?>
					 </ul>
				 </div>
				 <div class="comments">
					 <h3>Son Yorumlar</h3>
					 <ul>
					 <?php $sorgu = sonYorumlariGoster();
					 foreach ($sorgu as $s ):
					 ?>
					 <li><a href="<?php echo $icerik->icerikLinki($s->link);?>"><?php echo $s->baslik;?></a> içeriği için <?php echo $s->ad;?>   </li>
					 <?php endforeach;?>
					 </ul>
				 </div>
				 <div class="clearfix"></div>
				 <div class="recent">
					 <h3>Popüler İçerikler</h3>
					 <ul>
					 <?php $sorgu = populerIcerikleriGoster();
					 foreach ($sorgu as $s ):
					 ?>	
					 <li><a href="<?php echo $icerik->icerikLinki($s->link);?>"><?php echo $s->baslik;?></a>(<?php echo $s->hit;?>)</li>
					 <?php endforeach;?>
					 </ul>
				 </div>
				 <div class="categories">
					 <h3>Kategoriler</h3>
					 <ul>
					 <?php $sorgu = kategorileriGoster();
					 foreach($sorgu as $s):?>
					 <li><a href="<?php echo url;?>/kategori/<?php echo $s->link;?>"><?php echo $s->baslik;?></a></li>
					 <?php endforeach;?>
					 </ul>
				 </div>
				 <div class="clearfix"></div>
			  </div>
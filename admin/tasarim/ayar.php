<?php 
include('ust.php');?>
<?php include('yan.php');?>	  
		  
		 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
 	<!--banner-->	
		     <div class="banner">
		    	<h2>
				<a href="index.php">Anasayfa</a>
				<i class="fa fa-angle-right"></i>
				<span>Site Ayarları</span>
				
				</h2>


		    </div>
		<!--//banner-->

 	 <!--faq-->
<?php 
	if($_POST)
	{
		if($ayar->guncelle($_POST))
		{
			echo 'Ayarlar Başarıyla Güncellendi';
		}
		else
		{
			echo 'Ayarlar Güncellenirken Sorunla Karşılaştık';
		}
	}
	?>
 	<div class="grid-form">
 		<div class="grid-form1">
 		<h3 id="forms-example" class="">Ayarlar</h3>
 		<form method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Site Başlığı:</label>
    <input type="text" name="title" class="form-control" id="exampleInputEmail1" value="<?php echo $ayar->ayarDegeriAl('title');?>">
  </div>
      <div class="form-group">
    <label for="exampleInputEmail1">Site Açıklaması:</label>
    <input type="text" name="description" class="form-control" id="exampleInputEmail1" value="<?php echo $ayar->ayarDegeriAl('description');?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Yorum Yapılsın mı?:</label>
    <div class="radio-inline"><label><input type="radio" name="yorumdurum" <?php if($ayar->ayarDegeriAl('yorumdurum')==1):?>checked="checked"<?php endif;?>  value="1">Evet</label></div>
    <div class="radio-inline"><label><input type="radio" name="yorumdurum" <?php if($ayar->ayarDegeriAl('yorumdurum')==2):?>checked="checked"<?php endif;?>  value="2">Hayır</label></div>
  </div>
  
 <div class="form-group">
    <label for="exampleInputEmail1">Yorum Onaylansın mı?:</label>
    <div class="radio-inline"><label><input type="radio" name="yorumonay" <?php if($ayar->ayarDegeriAl('yorumonay')==1):?>checked="checked"<?php endif;?> value="1">Evet</label></div>
    <div class="radio-inline"><label><input type="radio" name="yorumonay" <?php if($ayar->ayarDegeriAl('yorumonay')==2):?>checked="checked"<?php endif;?> value="2">Hayır</label></div>
  </div>

  
 
  <button type="submit" class="btn btn-default">Güncelle</button>
</form>
</div>
</div>

	<?php include('alt.php');?>

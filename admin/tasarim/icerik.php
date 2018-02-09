<?php 
include('ust.php');?>
<?php include('yan.php');
if(isset($_GET['s']))
{
	$s = $_GET['s'];
}
else
{
	$s = '';
}
?>	  
		  
		 <div id="page-wrapper" class="gray-bg dashbard-1">
       <div class="content-main">
 
 	<!--banner-->	
		     <div class="banner">
		    	<h2>
				<a href="index.php">Anasayfa</a>
				<i class="fa fa-angle-right"></i>
				<span><a href="index.php?y=icerik">İçerik</a></span>
				<?php if($s=='ekle'){?>
					<i class="fa fa-angle-right"></i>
					<span>Ekle</span>
				<?php }?>
				<?php if($s=='guncelle'){?>
					<i class="fa fa-angle-right"></i>
					<span>Güncelle</span>
				<?php }?>
				</h2>


		    </div>
		<!--//banner-->

 	 <!--faq-->
<?php if($s=='ekle'){
	if($_POST)
	{
		if($icerik->ekle($_POST))
		{
			echo 'İçerik Başarıyla Eklendi';
		}
		else
		{
			echo 'İçerik Eklenirken Sorunla Karşılaştık';
		}
	}
	?>
 	<div class="grid-form">
 		<div class="grid-form1">
 		<h3 id="forms-example" class="">İçerik Ekle</h3>
 		<form method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">İçerik Adı*:</label>
    <input type="text" name="ad" class="form-control" id="exampleInputEmail1" placeholder="İçerik Adı">
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Kategori:</label>
    <select name="kategori" class="form-control">
    	<?php echo $icerik->kategoriOption();?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">İçerik Durumu:</label>
    <div class="radio-inline"><label><input type="radio" name="durum"  value="1">Yayında</label></div>
    <div class="radio-inline"><label><input type="radio" name="durum"  value="2">Taslak</label></div>
  </div>
  <div class="form-group">
	<label for="txtarea1" class="col-sm-2 control-label">İçerik</label>
	<div class="col-sm-12"><textarea name="icerik" id="txtarea1" cols="50" rows="15" class="form-control"></textarea></div>
</div>
<div class="form-group">
        <label for="exampleInputFile">Resmi Seçin</label>
        <input type="file" id="exampleInputFile" name="resimyukle">
        <p class="help-block">Resmi yüklemek istemiyorsanız direk linkini aşağı yapıştırabilirsiniz</p>
      </div>
<div class="form-group">
    <label for="exampleInputEmail1">Resim Linki:</label>
    <input type="text" name="resimlink" class="form-control" id="exampleInputEmail1" placeholder="http://">
  </div>

  
 
  <button type="submit" class="btn btn-default">Ekle</button>
</form>
</div>
</div>
<?php }elseif($s=='guncelle'){
if($_POST)
	{
		if($icerik->guncelle($_POST))
		{
			echo 'İçerik Başarıyla Güncellendi';
		}
		else
		{
			echo 'İçerik Güncellenirken Sorunla Karşılaştık';
		}
	}
$ic = $icerik->tekListele($_GET['id']);
	?>
 	<div class="grid-form">
 		<div class="grid-form1">
 		<h3 id="forms-example" class="">İçerik Ekle</h3>
 		<form method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">İçerik Adı*:</label>
    <input type="text" name="ad" class="form-control" id="exampleInputEmail1" value="<?php echo $ic->baslik;?>">
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Kategori:</label>
    <select name="kategori" class="form-control">
    	<?php echo $icerik->kategoriOption($ic->kategori);?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">İçerik Durumu:</label>
    <div class="radio-inline"><label><input type="radio" name="durum" <?php if($ic->durum==1):?>checked="checked" <?php endif;?>  value="1">Yayında</label></div>
    <div class="radio-inline"><label><input type="radio" name="durum" <?php if($ic->durum==2):?>checked="checked" <?php endif;?>  value="2">Taslak</label></div>
  </div>
  <div class="form-group">
	<label for="txtarea1" class="col-sm-2 control-label">İçerik</label>
	<div class="col-sm-12"><textarea name="icerik" id="txtarea1" cols="50" rows="15" class="form-control"><?php echo $ic->metin;?></textarea></div>
</div>
<div style="margin-top:15px;clear:both"><img src="<?php echo $ic->resim;?>" width="250"/></div>
<div class="form-group">
        <label for="exampleInputFile">Resmi Seçin</label>
        <input type="file" id="exampleInputFile" name="resimyukle">
        <p class="help-block">Resmi yüklemek istemiyorsanız direk linkini aşağı yapıştırabilirsiniz</p>
      </div>
<div class="form-group">
    <label for="exampleInputEmail1">Resim Linki:</label>
    <input type="text" name="resimlink" class="form-control" id="exampleInputEmail1" placeholder="http://">
  </div>
<input type="hidden" name="id" value="<?php echo $ic->id;?>"/>
 <input type="hidden" name="resim" value="<?php echo $ic->resim;?>"/>
 
 
  <button type="submit" class="btn btn-default">Düzenle</button>
</form>
</div>
</div>
	<?php
}else
{
	if($s=='sil')
	{
		$icerik->sil($_GET['id']);
	}
	$icerik->icerikSayisi = 20;
	$sonuc = $icerik->listele();

	?>
	<div class="blank">
		

				<div class="blank-page">
					
		        	<div class="divTable blueTable">
	<div class="divTableHeading">
	<div class="divTableRow">
	<div class="divTableHead">ID</div>
	<div class="divTableHead">Başlık</div>
	<div class="divTableHead">Link</div>
	<div class="divTableHead">Kategori</div>
	<div class="divTableHead">Tarih</div>
	<div class="divTableHead">Hit</div>
	<div class="divTableHead">Durum</div>
	<div class="divTableHead">İşlemler</div>
	</div>
	</div>
	<div class="divTableBody">
	<?php foreach($sonuc as $s){?>
		<div class="divTableRow">
		<div class="divTableCell"><?php echo $s->id;?></div>
		<div class="divTableCell"><?php echo $s->baslik;?></div>
		<div class="divTableCell"><?php echo $s->link;?></div>
		<div class="divTableCell"><?php echo $s->kategoriAd;?></div>
		<div class="divTableCell"><?php echo date('d/m/Y H:i:s',$s->tarih);?></div>
		<div class="divTableCell"><?php echo $s->hit;?></div>
		<div class="divTableCell"><?php if($s->durum==1):?><span style="color:green">Yayında</span> <?php else:?> <span style="color:red">Taslak</span><?php endif;?></div>
		<div class="divTableCell"><a href="index.php?y=icerik&s=guncelle&id=<?php echo $s->id;?>"><i class="fa fa-pencil"></i> </a> <a onclick="return confirm('Silmek istediğine emin misin?');" href="index.php?y=icerik&s=sil&id=<?php echo $s->id;?>"><i class="fa fa-trash"></i> </a></div>
		</div>
	<?php }?>


	</div>
	</div>
		<?php
		// determine page (based on <_GET>)


    $page = isset($_GET['sayfa']) ? ((int) $_GET['sayfa']) : 1;

    $totalItems = $icerik->toplamIcerik();
	$itemsPerPage = $icerik->icerikSayisi;
	$currentPage = $page;
	$urlPattern = 'index.php?y=icerik&sayfa=(:num)';

	$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
	echo $paginator;
    ?>
	       </div>
	       </div>

<?php }?>
	<?php include('alt.php');?>

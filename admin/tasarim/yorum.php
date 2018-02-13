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
				<span><a href="index.php?y=yorum">Yorum</a></span>
				
				<?php if($s=='guncelle'){?>
					<i class="fa fa-angle-right"></i>
					<span>Güncelle</span>
				<?php }?>
				</h2>


		    </div>
		<!--//banner-->

 	 <!--faq-->
<?php if($s=='guncelle'){
if($_POST)
	{
		if($yorum->guncelle($_POST))
		{
			echo 'Yorum Başarıyla Güncellendi';
		}
		else
		{
			echo 'Yorum Güncellenirken Sorunla Karşılaştık';
		}
	}
$ic = $yorum->tekListele($_GET['id']);
	?>
 	<div class="grid-form">
 		<div class="grid-form1">
 		<h3 id="forms-example" class="">Yorum Güncelle</h3>
 		<form method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Yorum Yapan:</label>
    <input type="text" name="ad" class="form-control" id="exampleInputEmail1" value="<?php echo $ic->ad;?>">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Yorum Durumu:</label>
    <div class="radio-inline"><label><input type="radio" name="durum" <?php if($ic->durum==1):?>checked="checked" <?php endif;?>  value="1">Onaylı</label></div>
    <div class="radio-inline"><label><input type="radio" name="durum" <?php if($ic->durum==2):?>checked="checked" <?php endif;?>  value="2">Onaysız</label></div>
  </div>
  <div class="form-group">
	<label for="txtarea1" class="col-sm-2 control-label">Yorum</label>
	<div class="col-sm-12"><textarea name="yorum" id="txtarea1" cols="50" rows="15" class="form-control"><?php echo $ic->yorum;?></textarea></div>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Yorum Yapan Mail:</label>
    <input type="text" name="mail" class="form-control" id="exampleInputEmail1" value="<?php echo $ic->mail;?>">
  </div>
<input type="hidden" name="id" value="<?php echo $ic->id;?>"/>

 
 
  <button type="submit" class="btn btn-default">Düzenle</button>
</form>
</div>
</div>
	<?php
}else
{
	if($s=='sil')
	{
		$yorum->sil($_GET['id']);
	}
	$yorum->icerikSayisi = 20;
	$sonuc = $yorum->listele();

	?>
	<div class="blank">
		

				<div class="blank-page">
					
		        	<div class="divTable blueTable">
	<div class="divTableHeading">
	<div class="divTableRow">
	<div class="divTableHead">ID</div>
	<div class="divTableHead">İçerik</div>
	<div class="divTableHead">Yorum Yapan</div>
	
	<div class="divTableHead">Tarih</div>
	<div class="divTableHead">Durum</div>
	<div class="divTableHead">İşlemler</div>
	</div>
	</div>
	<div class="divTableBody">
	<?php foreach($sonuc as $s){?>
		<div class="divTableRow">
		<div class="divTableCell"><?php echo $s->id;?></div>
		<div class="divTableCell"><?php echo $s->baslik;?></div>
		<div class="divTableCell"><?php echo $s->ad;?></div>
		<div class="divTableCell"><?php echo date('d/m/Y H:i:s',$s->tarih);?></div>
		<div class="divTableCell"><?php if($s->durum==1):?><span style="color:green">Onaylı</span> <?php else:?> <span style="color:red">Onaysız</span><?php endif;?></div>
		<div class="divTableCell"><a href="index.php?y=yorum&s=guncelle&id=<?php echo $s->id;?>"><i class="fa fa-pencil"></i> </a> <a onclick="return confirm('Silmek istediğine emin misin?');" href="index.php?y=yorum&s=sil&id=<?php echo $s->id;?>"><i class="fa fa-trash"></i> </a></div>
		</div>
	<?php }?>


	</div>
	</div>
		<?php
		// determine page (based on <_GET>)


    $page = isset($_GET['sayfa']) ? ((int) $_GET['sayfa']) : 1;

    $totalItems = $yorum->toplamIcerik();
	$itemsPerPage = $yorum->icerikSayisi;
	$currentPage = $page;
	$urlPattern = 'index.php?y=yorum&sayfa=(:num)';

	$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
	echo $paginator;
    ?>
	       </div>
	       </div>

<?php }?>
	<?php include('alt.php');?>

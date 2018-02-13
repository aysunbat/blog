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
				<span><a href="index.php?y=uye">Üyeler</a></span>
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
		if($uye->ekle($_POST))
		{
			echo 'Üye Başarıyla Eklendi';
		}
		else
		{
			echo 'Üye Eklenirken Sorunla Karşılaştık';
		}
	}
	?>
 	<div class="grid-form">
 		<div class="grid-form1">
 		<h3 id="forms-example" class="">Üye Ekle</h3>
 		<form method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Üye Nick*:</label>
    <input type="text" name="nick" class="form-control" id="exampleInputEmail1" placeholder="gecelerin_yargici_34">
  </div>
   
 <div class="form-group">
    <label for="exampleInputEmail1">Üye Şifre*:</label>
    <input type="password" name="sifre" class="form-control" id="exampleInputEmail1">
  </div>

  
 
  <button type="submit" class="btn btn-default">Ekle</button>
</form>
</div>
</div>
<?php }elseif($s=='guncelle'){
if($_POST)
	{
		if($uye->guncelle($_POST))
		{
			echo 'Üye Başarıyla Güncellendi';
		}
		else
		{
			echo 'Üye Güncellenirken Sorunla Karşılaştık';
		}
	}
$ic = $uye->tekListele($_GET['id']);
	?>
 	<div class="grid-form">
 		<div class="grid-form1">
 		<h3 id="forms-example" class="">Üye Düzenle</h3>
 		<form method="post" action="" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleInputEmail1">Üye Nick*:</label>
    <input type="text" name="nick" class="form-control" id="exampleInputEmail1" value="<?php echo $ic->nick;?>">
  </div>
   
 <div class="form-group">
    <label for="exampleInputEmail1">Üye Şifre*:</label>
    <input type="password" name="sifre" class="form-control" id="exampleInputEmail1">
  </div>

  <input type="hidden" name="id" value="<?php echo $ic->id;?>"/>
 
  <button type="submit" class="btn btn-default">Ekle</button>
</form>
</div>
</div>
	<?php
}else
{
	if($s=='sil')
	{
		$uye->sil($_GET['id']);
	}
	$uye->icerikSayisi = 20;
	$sonuc = $uye->listele();

	?>
	<div class="blank">
		

				<div class="blank-page">
					
		        	<div class="divTable blueTable">
	<div class="divTableHeading">
	<div class="divTableRow">
	<div class="divTableHead">ID</div>
	<div class="divTableHead">Nick</div>
	<div class="divTableHead">İşlemler</div>
	</div>
	</div>
	<div class="divTableBody">
	<?php foreach($sonuc as $s){?>
		<div class="divTableRow">
		<div class="divTableCell"><?php echo $s->id;?></div>
		<div class="divTableCell"><?php echo $s->nick;?></div>
		<div class="divTableCell"><a href="index.php?y=uye&s=guncelle&id=<?php echo $s->id;?>"><i class="fa fa-pencil"></i> </a> <a onclick="return confirm('Silmek istediğine emin misin?');" href="index.php?y=uye&s=sil&id=<?php echo $s->id;?>"><i class="fa fa-trash"></i> </a></div>
		</div>
	<?php }?>


	</div>
	</div>
		<?php
		// determine page (based on <_GET>)


    $page = isset($_GET['sayfa']) ? ((int) $_GET['sayfa']) : 1;

    $totalItems = $uye->toplamIcerik();
	$itemsPerPage = $uye->icerikSayisi;
	$currentPage = $page;
	$urlPattern = 'index.php?y=uye&sayfa=(:num)';

	$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
	echo $paginator;
    ?>
	       </div>
	       </div>

<?php }?>
	<?php include('alt.php');?>

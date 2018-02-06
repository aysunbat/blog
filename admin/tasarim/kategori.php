<?php include('ust.php');?>
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
				<span><a href="index.php?y=kategori">Kategori</a></span>
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
		if($kategori->ekle($_POST))
		{
			echo 'Kategori Başarıyla Eklendi';
		}
		else
		{
			echo 'Kategori Eklenirken Sorunla Karşılaştık';
		}
	}
	?>
 	<div class="grid-form">
 		<div class="grid-form1">
 		<h3 id="forms-example" class="">Kategori Ekle</h3>
 		<form method="post" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">Kategori Adı:</label>
    <input type="text" name="ad" class="form-control" id="exampleInputEmail1" placeholder="Kategori Adı">
  </div>
  
 
  <button type="submit" class="btn btn-default">Ekle</button>
</form>
</div>
</div>
<?php }elseif($s=='guncelle'){
if($_POST)
	{
		if($kategori->guncelle($_POST))
		{
			echo 'Kategori Başarıyla Güncellendi';
		}
		else
		{
			echo 'Kategori Güncellenirken Sorunla Karşılaştık';
		}
	}
$kat = $kategori->tekListele($_GET['id']);
	?>
 	<div class="grid-form">
 		<div class="grid-form1">
 		<h3 id="forms-example" class="">Kategori Güncelle</h3>
 		<form method="post" action="">
  <div class="form-group">
    <label for="exampleInputEmail1">Kategori Adı:</label>
    <input type="text" name="ad" class="form-control" id="exampleInputEmail1" value="<?php echo $kat->baslik;?>" placeholder="Kategori Adı">
  </div>
  
 <input type="hidden" value="<?php echo $_GET['id'];?>" name="id"/>
  <button type="submit" class="btn btn-default">Güncelle</button>
</form>
</div>
</div>
	<?php
}else
{
	if($s=='sil')
	{
		$kategori->sil($_GET['id']);
	}
	$sonuc = $kategori->listele();
	?>
	<div class="blank">
		

				<div class="blank-page">
					
		        	<div class="divTable blueTable">
	<div class="divTableHeading">
	<div class="divTableRow">
	<div class="divTableHead">ID</div>
	<div class="divTableHead">Adı</div>
	<div class="divTableHead">Link</div>
	<div class="divTableHead">İşlemler</div>
	</div>
	</div>
	<div class="divTableBody">
	<?php foreach($sonuc as $s){?>
		<div class="divTableRow">
		<div class="divTableCell"><?php echo $s->id;?></div>
		<div class="divTableCell"><?php echo $s->baslik;?></div>
		<div class="divTableCell"><?php echo $s->link;?></div>
		<div class="divTableCell"><a href="index.php?y=kategori&s=guncelle&id=<?php echo $s->id;?>"><i class="fa fa-pencil"></i> </a> <a onclick="return confirm('Silmek istediğine emin misin?');" href="index.php?y=kategori&s=sil&id=<?php echo $s->id;?>"><i class="fa fa-trash"></i> </a></div>
		</div>
	<?php }?>


	</div>
	</div>

	       </div>
	       </div>

<?php }?>
	<?php include('alt.php');?>

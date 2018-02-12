<?php

function sayfalama($toplamicerik,$iceriksayisi,$sayfa,$desen)
{

		include('admin/sinif/pagination.php');
		$totalItems = $toplamicerik;
		$itemsPerPage = $iceriksayisi;
		$currentPage = $sayfa;
		$urlPattern = $desen;

		//'index.php?y=icerik&sayfa=(:num)';

		$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
		echo $paginator;
}
<div class="container" id="searchContainer">
	<div class="row">
		<div class="col-sm-9" id="searchResult">
			<?php if($content){ 
				foreach($content as $key => $row){?>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-3">
								<img class="albumart" src="<?= base_url('assets/albumart.jpg'); ?>"/>
							</div>
							<div class="col-sm-9">
								<h2><?= $row->title?></h2>
								<h5>Artist: <?= $row->artist?></h5>
								<h5>Album: <?= $row->album?></h5>
							</div>
						</div>
					</div>

					<?php $totalrow = $key;

				} ?> 
				<div class="row">
					<div class="col-sm-12 text-center">
						<?php $prevpageValue = $currentpageValue - 1;?>
						<?php if ($currentpageValue != 0) { // hides when page = 0 ?>
							<a class="text-reset" href="<?= base_url('index.php/search?search='.$searchValue.'&page='.$prevpageValue); ?>"><< Prev</a>
						<?php }?>
						<?php if ($totalrow == 9) { // value of limit search ?>
							<a class="text-reset" href="<?= base_url('index.php/search?search='.$searchValue.'&page='.$nextpageValue); ?>">Next >></a>
						<?php } ?>
					</div>
				</div>


			<?php }else{ ?>
				<div class="col-sm-12 resultNone">
					<h3>There is no result for <?= $searchValue; ?> :(</h3>
					<h5>Try Harder! Music is forever...</h5>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		<?php if($searchCount){ ?>
			$('.section-1 > div').append('<h3>About <?= $searchCount; ?> result/s</h3>');
		<?php } ?>

	});
</script>

<style type="text/css">
	#searchResult div{
		padding: 10px;
	}

	#searchResult .resultNone{
		padding: 80px 30px;
	}


	.albumart{
		width: 100%;
	}

</style>

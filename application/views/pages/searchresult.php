<div class="container" id="searchContainer">
	<div class="row">
		<div class="col-sm-9" id="searchResult">
			<?php if($content){ 
				foreach($content as $row){?>
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

				<?php }}else{ ?>
					<div class="col-sm-12 resultNone">
						<h3>There is no result for <?= $searchValue; ?> :(</h3>
						<h5>Try Harder! Music is forever...</h5>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<script type="text/javascript">

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

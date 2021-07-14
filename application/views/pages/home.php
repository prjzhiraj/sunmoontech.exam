<div class="container-fluid main-con">
	<div class="row section-1">
		<div class="col-sm-12 text-center justify-content-center align-items-center">
			<h1>Welcome to Lyrics PH</h1>
			<form class="section-1-search" action="<?= base_url('/index.php/search'); ?>" method="get">
				<center>
					<input class="form-control me-2" type="search" placeholder="Search Lyrics" name="search" aria-label="Search">
					<input type="hidden" name="page" value="0">
					<button class="btn btn-outline-light" type="submit">Search Lyrics</button>
				</center>
			</form>
		</div>
	</div>

	<div class="row section-2">
		<div class="col-sm-12 text-center title font-weight-bold"><h1 class="font-weight-bold">RECENT SONGS</h1></div>
		<?php 
		if($content){
			foreach($content as $key => $row){
				echo '<div class="col-sm-3 text-center show_title title_'.$row->id.'"><div class="col"><img src="'.base_url('assets/albumart-'.$key.'.jpg').'"/><a class="link-dark" href="'.base_url('index.php/song/'.$row->title).'"><h4>'.$row->title.'</h4></a><h6>'.$row->artist.'</h6></div></div>';
			}	
		}else{ ?>
			<script type="text/javascript">$('.section-2').hide();</script>
		<?php } ?>
		<div class="col-sm-12 text-center"><button type="button" class="btn btn-lg btn-success">See more Lyrics</button></div>
	</div>

	<div class="row section-3">
		<div class="col-sm-12">
			
		</div>
	</div>
</div>

<script type="text/javascript">

</script>

<style type="text/css">

	.section-1-search input{
		border-color: white;
		background: none;
		color: white;
		max-width: 500px; 
		margin-bottom: 10px;
	}

	.section-1-search input::placeholder{
		color: white;
	}

	.section-1-search input:focus{
		border-color: white;
		background: none;
		color: white;
	}

	.section-1{
		background: url("<?= base_url('assets/sect-1bg.jpg'); ?>");
		background-position: center;
		background-size: cover;
		height: 100vh;
		display:table;
		width: calc(100vw - 17px);

	}
	.section-1 div{
		background: #0000007a;
		color: white;
		vertical-align:middle;
		display:table-cell;
		/*display: flex;*/
	}

	.section-2{
		padding: 80px 100px;
	}

	.section-2 .show_title > div{
		border-radius: 15px;
		padding: 20px 10px;
		min-height: 300px;
		margin-bottom: 20px;
	}

	.section-2 img{
		margin-bottom: 10px;
		width: 190px;
	}

	.section-2 .title{
		margin-bottom: 20px;
		font-weight: 800;
	}

	.section-2 button {
		margin: 30px 0px;
	}


</style>

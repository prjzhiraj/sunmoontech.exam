<div class="container">
	<div class="row">
		<div class="col-sm-3" id="lyrics_details">
			<img src="<?= base_url('assets/albumart.jpg'); ?>" id="album_art"/>
			<div class="col">
				by the album of
				<h4><?= $content[0]->album; ?></h4>
			</div>
			<div class="col">
				Created by
				<h4><?= $content[0]->fname.' '.$content[0]->sname; ?></h4>
			</div>
			<div class="col">
				Created on
				<h4><?= gmdate("F j, Y", $content[0]->unix_date_c); ?></h4>
			</div>
		</div>
		<div class="col-sm-9" id="lyrics_content">
			<p id="lyrics" class="blockquote" disabled style="white-space: pre-wrap;"><?= $content[0]->lyrics; ?></p>
			
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.section-1 > div').append('<h4><?= $content[0]->artist; ?></h4>');
	});
</script>

<style type="text/css">
	#lyrics_content{
		padding: 80px 30px;
	}

	#album_art{
		width: 100%;
		margin-bottom: 10px;
	}
</style>
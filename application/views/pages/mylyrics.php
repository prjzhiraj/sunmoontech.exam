<div class="container-fluid">	
	<div class="row section-2">
		<div class="col-sm-12 text-center" style="margin-bottom: 20px">
			<h2>Your Most Viewed Songs</h2>
		</div>
		<?php 
		if($songs['mostviewed']){
			foreach($songs['mostviewed'] as $key => $row){ ?>
				<div class="col-sm-3 text-center show_title title_<?= $row->id; ?>"><div class="col"><img src="<?= base_url('assets/albumart-'.$key.'.jpg'); ?>"/><a class="link-dark" href="<?= base_url('index.php/song/'.$row->title); ?>" target="_blank"><h4><?= $row->title; ?></h4></a><h6><?= $row->artist; ?></h6><h6><?= $row->views; ?> Views</h6></div></div>
			<?php	}
		}else{ ?>
			<div class="col-sm-12 text-center"> 
				<h4>You have no Lyrics yet.</h4>
				<h5>But you can add more!</h5>
			</div>
		<?php } ?>
	</div>
</div>

<div class="container-fluid main-container">
	<div class="row align-items-center">
		<div class="col-sm-12 text-center" style="margin-bottom: 20px">
			<h2>All Lyrics</h2>
		</div>
		<div class="col-sm-12 tbl_col">
			<table id="lyrics_tbl" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Song Title</th>
						<th>Artist</th>
						<th>Album</th>
						<th>Date Created</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if($songs['allsongs']){
						foreach($songs['allsongs'] as $row){
							echo '<tr><td><a class="link-dark" href="'.base_url('index.php/song/'.$row->title).'" target="_blank">'.$row->title.'</a></td><td>'.$row->artist.'</td><td>'.$row->album.'</td><td>'.$row->date_created.'</td><td><button type="button" class="btn btn-sm btn-success" onclick="editSongModal('.$row->id.')">Edit</button> <button type="button" class="btn btn-sm btn-danger" onclick="deleteSongModal('.$row->id.')">Delete</button></td></tr>';
						}
					}
					?>
				</tbody>
			</table>

			<button type="button" class="btn btn-success" data-toggle="modal" onclick="addNewSongModal()">Add New Song</button>

		</div>
	</div>
</div>


<script type="text/javascript">
	var base_url = '<?= base_url('index.php/'); ?>';
	var site_url = '<?= site_url(uri_string()); ?>';
	$('#lyrics_tbl').DataTable();

	function textAreaAdjust(element) {
		element.style.height = "90px";
		element.style.height = (25+element.scrollHeight)+"px";
	}

	function addNewSongModal(){
		$("#lyrics_content").css("height", "90px");
		$('#lyrics_content').empty();
		$('#lyrics_form').show();
		$('.delete_msg').remove();
		$('#managesongModal .modal-dialog').removeClass('modal-sm modal-dialog-centered').addClass('modal-xl');
		$('#lyrics_form').trigger("reset");
		$('#updateID').remove();
		$('#ModalTitle').empty();
		$('#ModalTitle').append('Add New Song');
		$('#managesongModal .modal-footer').empty();
		$('#managesongModal .modal-footer').append('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <button type="button" class="btn btn-success" onclick="saveNewLyrics()">Save</button>');
		$('#managesongModal').modal('show');
	}

	function deleteSongModal(id){
		$('#lyrics_form').hide();
		$('.delete_msg').remove();
		$('#managesongModal .modal-dialog').removeClass('modal-xl').addClass('modal-sm modal-dialog-centered');
		$('#lyrics_form').trigger("reset");
		$('#updateID').remove();
		$('#ModalTitle').empty();
		$('#ModalTitle').append('Delete Song');
		$('#managesongModal .modal-body').append('<span class="delete_msg">Are you sure you want to delete this song?</span>');
		$('#managesongModal .modal-footer').empty();
		$('#managesongModal .modal-footer').append('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <button type="button" class="btn btn-danger" onclick="deleteLyrics('+id+')">Delete</button>');
		$('#managesongModal').modal('show');
	}

	function editSongModal(id){
		$("#lyrics_content").css("height", "90px");
		$('#lyrics_content').empty();
		$('.delete_msg').remove();
		$('#managesongModal .modal-dialog').removeClass('modal-sm modal-dialog-centered').addClass('modal-xl');
		$('#lyrics_form').trigger("reset");
		$('#updateID').remove();
		$('#ModalTitle').empty();
		$('#ModalTitle').append('Edit Song');
		$('#lyrics_form').show();
		$('#managesongModal .modal-footer').empty();
		$('#managesongModal .modal-footer').append('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> <button type="button" class="btn btn-success" onclick="updateLyrics()">Update</button>');

		$.ajax({
			url: base_url+'editSong',
			type: "POST",
			data: $.param({id: id}),
			dataType: "JSON",
			cache: false,
			processData: false,
			success: function (data) {
				if(data){
					$('#title').val(data[0].title);
					$('#artist').val(data[0].artist);
					$('#album').val(data[0].album);
					$('#lyrics_content').append(data[0].lyrics);	
					$('#lyrics_form').append('<input type="hidden" id="updateID" name="id" value="'+data[0].id+'"/>');	
				}else if(data==false){
					$('*').modal('hide');
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {
			}
		});
		$('#managesongModal').modal('show');
	}

	function deleteLyrics(id){
		hideSongAlert();
		$('#managesongModal .modal-footer').hide();
		$.ajax({
			url: base_url+'deleteLyrics',
			type: "POST",
			dataType: "JSON",
			data: $.param({id: id}),
			cache: false,
			processData: false,
			success: function (data) {
				$('.delete_msg').remove();
				refreshSongList();
				$('#managesongModal .modal-body').append('<div class="alert alert-success success_alert">The Song has been successfully deleted.</div>');
				setTimeout(function(){
					$('*').modal('hide');
					setTimeout(function(){
						$('.success_alert').remove();
						$('#managesongModal .modal-footer').show();
					},500);

				}, 1500);

			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});	
	}

	function updateLyrics(){
		$('#managesongModal .modal-footer').hide();
		hideSongAlert();
		$.ajax({
			url: base_url+'updateLyrics',
			type: "POST",
			dataType: "JSON",
			data: $('#lyrics_form').serialize(),
			cache: false,
			processData: false,
			success: function (data) {
				if(data.status){
					refreshSongList();
					$('#updateID').remove();
					$('#lyrics_form').hide();
					$('#managesongModal .modal-dialog').addClass('modal-dialog-centered');
					$('#managesongModal .modal-body').append('<div class="alert alert-success success_alert">The Song has been successfully updated.</div>');
					setTimeout(function(){
						$('*').modal('hide');
						setTimeout(function(){
							$('.success_alert').remove();
							$('#managesongModal .modal-footer').show();
						},500);

					}, 1500);
				}else{
					showSaveLyricsAlert(data.err_msg);
				}

			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});	
	}

	function refreshSongList(){
		$('#lyrics_tbl tbody').empty();
		$.ajax({
			url: base_url+'refreshSongList',
			type: "POST",
			dataType: "JSON",
			data: $('#lyrics_form').serialize(),
			cache: false,
			processData: false,
			success: function (data) {
				$('#lyrics_tbl').DataTable().clear().destroy();
				$.each(data, function(key, value){
					$('#lyrics_tbl tbody').append('<tr><td><a class="link-dark" href="'+base_url+'index.php/song/'+value.title+'" target="_blank">'+value.title+'</a></td><td>'+value.artist+'</td><td>'+value.album+'</td><td>'+value.date_created+'</td><td><button type="button" class="btn btn-sm btn-success" onclick="editSongModal('+value.id+')">Edit</button> <button type="button" class="btn btn-sm btn-danger" onclick="deleteSongModal('+value.id+')">Delete</button></td></tr>');
				});
				$('#lyrics_tbl').DataTable();
			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});	
	}

	function saveNewLyrics(){
		hideSongAlert();
		$('#managesongModal .modal-footer').hide();
		$.ajax({
			url: base_url+'saveNewLyrics',
			type: "POST",
			dataType: "JSON",
			data: $('#lyrics_form').serialize(),
			cache: false,
			processData: false,
			success: function (data) {
				if(data.status){
					refreshSongList();
					$('#lyrics_form').hide();
					$('#managesongModal .modal-dialog').addClass('modal-dialog-centered');
					$('#managesongModal .modal-body').append('<div class="alert alert-success success_alert">The Song has been successfully saved.</div>');
					setTimeout(function(){
						$('*').modal('hide');
						setTimeout(function(){
							$('.success_alert').remove();
							$('#managesongModal .modal-footer').show();
						},500);
					}, 1500);
				}else{
					showSaveLyricsAlert(data.err_msg);
				}

			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});	
	}

	function showSaveLyricsAlert($content){
		$('#lyrics_form').append('<div class="row lyrics_alert">'+$content+'</div>');
	}

	function hideSongAlert(){
		$('.lyrics_alert').remove();
	}

</script>

<style type="text/css">
	.main-container{
		padding: 80px 100px;
		background: #efefef;
	}

	.lyrics_alert{
		margin: 0px;
	}

	.lyrics_alert div{
		padding: 10px 20px;
	}

	.lyric_input textarea{
		min-height: 90px;
	}

	.section-2{
		padding: 80px 100px;
	}

	.section-2 .show_title > div{
		border-radius: 15px;
		background: white;
		padding: 20px 10px;
		min-height: 300px;
		background: #e1e1e1;
		margin: 40px 20px;
	}

	.section-2 .show_title{
		padding: 0px;
	}

	.section-2 img{
		width: 190px;
		margin-bottom: 10px;
	}

	.section-2 .title{
		margin-bottom: 20px;
		font-weight: 800;
	}

	.section-2 button {
		margin: 30px 0px;
	}

	.lyric_input{
		margin-bottom: 20px;
	}
</style>

<?php $this->load->view('modals/managesongmodal'); ?>
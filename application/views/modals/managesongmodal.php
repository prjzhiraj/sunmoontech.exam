<div class="modal fade" id="managesongModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-scroll">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ModalTitle">Add New Song</h5>
			</div>
			<div class="modal-body">
				<form id="lyrics_form">
					<div class="row">
						<label>Song Title</label>
						<div class="col lyric_input">
							<input onfocus="hideSongAlert()" type="text" class="form-control" id="title" name="title" placeholder="Song Title">
						</div>
						<label>Artist</label>
						<div class="col lyric_input">
							<input onfocus="hideSongAlert()" type="text" class="form-control" id="artist" name="artist" placeholder="Artist">
						</div>
						<label>Album</label>
						<div class="col lyric_input">
							<input onfocus="hideSongAlert()" type="text" class="form-control" id="album" name="album" placeholder="Album">
						</div>
						<label for="lyrics_content" class="form-label">Lyrics Content</label>
						<div class="col lyric_input">
							<textarea class="form-control" id="lyrics_content" name="lyrics" rows="3" placeholder="Enter your Lyrics here..." onkeyup="textAreaAdjust(this)" onclick="textAreaAdjust(this)"></textarea>
						</div>
						
						<br>
					</div>
				</form>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
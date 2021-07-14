

<?php 
if(!$this->session->userdata('user_id')){
	$this->load->view('modals/loginmodal');
	$this->load->view('modals/registrationmodal'); 
}?>

</body>

<footer>
	<div class="container-fluid footer text-lg-start bg-light text-muted">
		<div class="row footer-row">
			<div class="col-sm-2">
				<h6 class="text-uppercase fw-bold mb-4">
					Menu
				</h6>
				<p>
					<a href="<?= base_url(); ?>" class="text-reset">Home</a>
				</p>
				<?php if($this->session->userdata('user_id')){ ?>
					<p>
						<a class="text-reset" href="<?= base_url('index.php/mylyrics'); ?>">My Lyrics</a>
					</p>
					<p>
						<a href="<?= base_url('index.php/logout'); ?>" class="text-reset" onclick="logoutModal();">Log out</a>
					</p>
				<?php }else{ ?>
					<p>
						<a href="#!" class="text-reset" onclick="loginModal();">Log in</a>
					</p>
					<p>
						<a href="#!" class="text-reset" onclick="registerModal();">Sign up</a>
					</p>

				<?php }?>
			</div>
			<div class="col-sm-6">
				<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Be a King or a Street Sweeper, everyone dances with a Grim Reaper congue vehicula risus. Pellentesque finibus pellentesque euismod.</h3>
				<hr>
				<div class="icons">
					<i class="fa fa-facebook-square" aria-hidden="true"></i>
					<i class="fa fa-instagram" aria-hidden="true"></i>
					<i class="fa fa-twitter" aria-hidden="true"></i>
					<i class="fa fa-youtube-play" aria-hidden="true"></i>
					<i class="fa fa-linkedin-square" aria-hidden="true"></i>
				</div>
				
			</div>
		</div>
		<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
			© 2021 Copyright:
			<a class="text-dark" href="<?= base_url(); ?>">Lyrics PH</a>
		</div>
	</div>
</footer>

<script type="text/javascript">
	var base_url = '<?= base_url('index.php/'); ?>';
	var site_url = '<?= uri_string(); ?>'

	<?php if(!$this->session->userdata('user_id')){ // methods for non registered users only ?>

		function loginModal(){
			$('#loginmodal').modal('show');
		}

		function registerModal(){
			$('*').modal('hide');
			$('.regInputHelp').remove();
			$('#register_form').show(); 
			$('#registerModal').modal('show');
		}

		function hideLoginAlert(){
			$('.login_alert').remove();
		}

		function showLoginAlert(){
			$('#login_form').after('<div class="alert alert-danger login_alert" role="alert">The Email Address or Password did not match.</div>');
		}

		function login(){
			hideLoginAlert();
			if(!$('#login_form input').val()){
				showLoginAlert();
			}else{
				$.ajax({
					url: base_url+'login',
					type: "POST",
					dataType: "JSON",
					data: $('#login_form').serialize(),
					cache: false,
					processData: false,
					success: function (data) {
						if(data.status){
							window.location.href = base_url;
						}else{
							showLoginAlert();
						}

					},
					error: function (jqXHR, textStatus, errorThrown) {

					}
				});	
			}
		}

		function register(){
			$('.regInputHelp').remove();
			$.ajax({
				url: base_url+'/registerAccount',
				type: "POST",
				dataType: "JSON",
				data: $('#register_form').serialize(),
				cache: false,
				processData: false,
				success: function (data) {
					if(data.status){
						$('#register_form').hide();
						$('#registerModal .modal-footer').hide();
						$('#register_form')[0].reset();
						$('#registerModal .modal-body').append('<div class="alert alert-success success_alert">Registration Successful.</div>');
						setTimeout( function(){
							$('#registerModal').modal('hide'); 
							setTimeout( function(){
								$('.success_alert').remove();
								$('#registerModal .modal-footer').show();
							},1000);
						},2000);
					}else{
						showRegisterAlert(data.err_msg);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {

				}
			});
		}

		function showRegisterAlert($content){
			$('#register_form').append('<div class="row regInputHelp">'+$content+'</div>');
		}

	<?php } ?>
</script>

<style type="text/css">

	html{
		/*background: #e1e1e1;*/
	}

	body{
		background: none;
	}

	div.icons{
		font-size: 50px;
	}

	.regInputHelp{
		margin: 0px;
	}

	.regInputHelp div{
		padding: 10px 20px;
	}

	.footer{
		background: black;
		color: white;
	}

	.footer-row{
		padding: 80px 80px;
	}

	.main_nav {
		position: relative;
	}
	.main_nav.navbar-brand {
		transform: translateX(-50%);
		left: 50%;
		position: absolute;
	}

	.main_nav img{
		width: 180px;
	}

	.welcome_nav span{
		font-size: 16px;
	}

	.title-con > .section-1{
		background: url("<?= base_url('assets/sect-1bg.jpg'); ?>");
		background-position: center;
		background-size: cover;
		min-height: 150px;
	}
	.title-con > .section-1 div{
		background: #0000007a;
		color: white;
		display: block;
		padding: 80px 90px;
	}

	.login_col{
		padding: 70px 20px 40px 20px;
		background: white;
		border-radius: 20px;
		position: relative;
		box-shadow: 0px 5px 20px -8px;
	}

	.icon_container{
		top: -140px;
		left: 50%;
		background: #d7d7d7;
		border-radius: 40px;
		padding: 10px;
		position: absolute;
		transform: translate(-50%, 10px);
	}

	.icon_container img{
		width: 300px;
	}

	.login_row{
		display: flex !important;
		height: 100vh !important;
	}

	.login_container{
		height: 100% !important;
	}

	#login_form{
		padding-bottom: 20px;
	}

	#register_form{
		padding-bottom: 20px;
	}

</style>


</html>
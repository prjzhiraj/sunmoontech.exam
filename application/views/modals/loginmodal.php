<div class="modal fade" id="loginmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content login_col">
				<div class="modal-body ">
					<!-- <div class="row justify-content-center align-items-center login_row"> -->
						<!-- <div class="col-sm-12 align-self-center login_col"> -->
							<div class="icon_container">
								<img src="<?= base_url('assets/logo.png') ?>"/>
							</div>
							<form id="login_form">
								<div class="form-group">
									<label for="email">User Name or Email address</label>
									<input onfocus="hideLoginAlert()" type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="User Name or Email">
								</div>
								<br>
								<div class="form-group">
									<label for="password">Password</label>
									<input onfocus="hideLoginAlert()" type="password" class="form-control" id="password" name="password" placeholder="Password">
								</div>
							</form>
							<button type="button" class="btn btn-primary btn-block" id="btn_login" style="display: block !important; width: 100%;" onclick="login()">Login</button>
							<hr>
							<button type="button" class="btn btn-success btn-block" style="display: block !important; width: 100%;" onclick="registerModal()">Sign up New Account</button>
						<!-- </div> -->
					<!-- </div> -->
				</div>
			</div>
		</div>
	</div>
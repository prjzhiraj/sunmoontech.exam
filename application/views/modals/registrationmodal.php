<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Sign up New Account</h5>
			</div>
			<div class="modal-body">
				<form id="register_form">
					<div class="row">
						<label>Full Name</label>
						<div class="col fname_col">
							<input type="text" class="form-control" id="fname" name="fname" placeholder="First name">
						</div>
						<div class="col lname_col">
							<input type="text" class="form-control" id="sname" name="sname" placeholder="Last name">
						</div>
						<br><br>
						<label>Gender</label>
						<div class="col-sm-12 gender_col">
							<select class="form-select" anameria-label="Select Gender" name='gender'>
								<option selected disabled>Select Gender</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								<option value="Other">Other</option>
							</select>			
						</div>

					</div>
					<br>
					<div class="form-group email_col">
						<label for="email">Email address</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
					</div>
					<br>
					<div class="row password_col">
						<div class="col">
							<label for="password">Password</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Password">
						</div>
						<div class="col">
							<label for="confirmpassword">Confirm Password</label>
							<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
						</div>
					</div>
					<br>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="register()">Sign up</button>
			</div>
		</div>
	</div>
</div>
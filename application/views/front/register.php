<div class="register-box pull-left" xmlns="http://www.w3.org/1999/html">
	<div class="register-logo">
		<a href="javascript:void(0);"><b>Profile</b> Registration</a>
	</div>

	<?php $val_error = validation_errors(); ?>
	<?php $error = empty( $val_error ) ? $this->session->flashdata( 'error' ) : $val_error; ?>
	<?php $success = $this->session->flashdata( 'success' ); ?>
	<?php if ( isset( $error ) ) : ?>
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<?= $error ?>
		</div>
	<?php elseif ( isset( $success ) ) : ?>
		<div class="callout callout-success">
			<?= $success ?>
		</div>
	<?php endif; ?>

	<div class="register-box-body">

		<p class="login-box-msg">Register new profile<?php echo is_loggedin() ? ' (<a href="' . base_url( 'dashboard' ) . '"><b>Go to dashboard</b></a>)' : ' (<a href="' . base_url( 'login' ) . '"><b>or login</b></a>)'; ?></p>

		<?= form_open( 'registration/register', array( 'id' => 'registration-form' ) ) ?>
			<div class="box-group" id="accordion">
				<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Personal Details</h3>
					</div>
						<div class="box-body">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group has-feedback">
										<label>Full Name</label>
										<input name="name" id="name" class="form-control" placeholder="Full name" value="<?= set_value( 'name' ); ?>" required>
										<span class="glyphicon glyphicon-user form-control-feedback"></span>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label>Church</label>
										<select class="form-control select2" name="church" id="church" required>
											<option value="">Select church</option>
											<?php if ( ! empty( $churches ) ) : ?>
												<?php foreach ( $churches as $church ) : ?>
													<option value="<?= $church->id ?>" <?= set_select( 'church', $church->id ); ?>><?= $church->name ?></option>
												<?php endforeach; ?>
											<?php endif; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-3">
									<div class="form-group">
										<label>Date of Birth</label>
										<input type="date" name="dob" id="dob" class="form-control" placeholder="Date of birth" value="<?= set_value( 'dob' ); ?>" required>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group has-feedback">
										<label>Gender</label><br/>
										<input type="radio" name="gender" value="M" class="flat-red" <?php echo set_radio( 'gender', 'M' ); ?>> Male
										<input type="radio" name="gender" value="F" class="flat-red"  <?php echo set_radio( 'gender', 'F' ); ?>> Female
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label>Height (cm)</label>
										<input type="number" name="height" id="height" class="form-control" placeholder="Height in c.m" value="<?= set_value( 'height' ); ?>">
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group">
										<label>Weight (kg)</label>
										<input type="number" name="weight" id="weight" class="form-control" placeholder="Weight in kg" value="<?= set_value( 'weight' ); ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label>State</label>
										<select class="form-control select2" name="state" id="state" required>
											<option value="">Select state</option>
											<?php if ( ! empty( $states ) ) : ?>
												<?php foreach ( $states as $state ) : ?>
													<option value="<?= $state->id ?>" <?= set_select( 'state', $state->id ); ?>><?= $state->name ?></option>
												<?php endforeach; ?>
											<?php endif; ?>
										</select>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label>District</label>
										<select class="form-control select2" name="district" id="district">
											<option value="">Select district</option>
											<?php if ( ! empty( $districts ) ) : ?>
												<?php foreach ( $districts as $district ) : ?>
													<option value="<?= $district->id ?>" <?= set_select( 'district', $district->id ); ?>><?= $district->name ?></option>
												<?php endforeach; ?>
											<?php endif; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Education & Job</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label>Education</label>
									<select class="form-control select2" name="education" id="education" required>
										<option value="">Select education</option>
										<option value="none" <?= set_select( 'education', 'none' ); ?>>None</option>
										<option value="hs" <?= set_select( 'education', 'hs' ); ?>>High School</option>
										<option value="hsc" <?= set_select( 'education', 'hsc' ); ?>>Higher Secondary</option>
										<option value="ug" <?= set_select( 'education', 'ug' ); ?>>Graduate</option>
										<option value="pg" <?= set_select( 'education', 'pg' ); ?>>Post Graduate</option>
									</select>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label>Education Details</label>
									<input name="education_details" id="education_details" class="form-control" placeholder="Education details" value="<?= set_value( 'education_details' ); ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label>Job</label>
									<select class="form-control select2" name="job" id="job" required>
										<option value="">Select job</option>
										<option value="none" <?= set_select( 'job', 'none' ); ?>>None</option>
										<option value="private" <?= set_select( 'job', 'private' ); ?>>Private</option>
										<option value="govt" <?= set_select( 'job', 'govt' ); ?>>Government</option>
										<option value="business" <?= set_select( 'job', 'business' ); ?>>Business</option>
									</select>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label>Job Details</label>
									<input name="job_details" id="job_details" class="form-control" placeholder="Job details" value="<?= set_value( 'job_details' ); ?>">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Family & Church Details</h3>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label>Father's Name</label>
									<input name="father_name" id="father_name" class="form-control" placeholder="Full name" value="<?= set_value( 'father_name' ); ?>" required>
									<span class="glyphicon glyphicon-user form-control-feedback"></span>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label>Father's Occupation</label>
									<input name="father_occupation" id="father_occupation" class="form-control" placeholder="Father's occupation" value="<?= set_value( 'father_occupation' ); ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label>Father's Contact Number</label>
									<input type="number" name="father_number" id="father_number" class="form-control" placeholder="Contact number" value="<?= set_value( 'father_number' ); ?>" required>
									<span class="glyphicon glyphicon-phone form-control-feedback"></span>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label>Mother's Name</label>
									<input name="mother_name" id="mother_name" class="form-control" placeholder="Full name" value="<?= set_value( 'mother_name' ); ?>">
									<span class="glyphicon glyphicon-user form-control-feedback"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label>Church Elder Name</label>
									<input name="elder_name" id="elder_name" class="form-control" placeholder="Full name" value="<?= set_value( 'elder_name' ); ?>" required>
									<span class="glyphicon glyphicon-user form-control-feedback"></span>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group has-feedback">
									<label>Church Elder Contact Number</label>
									<input type="number" name="elder_number" id="elder_number" class="form-control" placeholder="Contact number" value="<?= set_value( 'elder_number' ); ?>" required>
									<span class="glyphicon glyphicon-phone form-control-feedback"></span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Photos</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12">
								<?php $upload_key = set_value( 'upload_key', time() ); ?>
								<input type="hidden" name="upload_key" id="upload_key" value="<?= $upload_key; ?>">
								<div class="dropzone" id="dropzone-upload" action="<?= base_url( 'registration/upload/' . $upload_key ); ?>" maxFiles="2"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12">
						<button type="submit" id="register-submit" class="btn btn-primary btn-block btn-flat">Register</button>
					</div>
				</div>
		</form>
	</div>

	</div>
<!-- /.form-box -->
</div>
<!-- /.register-box -->
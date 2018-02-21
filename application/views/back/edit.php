<?php
// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' ); ?>

<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?= base_url( 'assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p><?php echo $this->session->userdata( 'username' ) ? ucwords( $this->session->userdata( 'username' ) ) : 'User'; ?></p>
					<a href="<?= base_url( 'logout' ); ?>"><i class="fa fa-circle text-success"></i> Logout</a>
				</div>
			</div>
			<!-- /.search form -->
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header">Profiles</li>
				<li class="treeview active">
					<a href="<?= base_url( 'dashboard/profiles' ); ?>">
						<i class="fa fa-users"></i> <span>Profile List</span>
					</a>
				</li>
				<li class="treeview">
					<a href="<?= base_url(); ?>" target="_blank">
						<i class="fa fa-user-plus"></i> <span>Add Profile</span>
					</a>
				</li>
				<li class="header">Other</li>
				<li class="treeview">
					<a href="<?= base_url( 'dashboard/contact' ); ?>" target="">
						<i class="fa fa-envelope"></i> <span>Conact Us</span>
					</a>
				</li>
			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Edit Profile
				<small>gamos search</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?= base_url( 'dashboard/profiles' ); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Profile Details</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-8">
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

					<?= form_open( 'dashboard/profile/update/' . base64_encode( $profile->profile_id ), array( 'id' => 'edit-form' ) ) ?>
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
											<input name="name" id="name" class="form-control" placeholder="Full name" value="<?= set_value( 'name', $profile->name ); ?>" required>
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
														<option value="<?= $church->id ?>" <?= set_select( 'church', $church->id, $profile->church === $church->id ); ?>><?= $church->name ?></option>
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
											<input type="date" name="dob" id="dob" class="form-control" placeholder="Date of birth" value="<?= set_value( 'dob', $profile->dob ); ?>" required>
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group has-feedback">
											<label>Gender</label><br/>
											<input type="radio" name="gender" value="M" class="flat-red" <?php echo set_radio( 'gender', 'M', $profile->gender === 'M' ); ?>> Male
											<input type="radio" name="gender" value="F" class="flat-red"  <?php echo set_radio( 'gender', 'F', $profile->gender === 'F' ); ?>> Female
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label>Height (cm)</label>
											<input type="number" name="height" id="height" class="form-control" placeholder="Height in c.m" value="<?= set_value( 'height', $profile->height ); ?>">
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label>Weight (kg)</label>
											<input type="number" name="weight" id="weight" class="form-control" placeholder="Weight in kg" value="<?= set_value( 'weight', $profile->weight ); ?>">
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
														<option value="<?= $state->id ?>" <?= set_select( 'state', $state->id, $profile->state === $state->id ); ?>><?= $state->name ?></option>
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
														<option value="<?= $district->id ?>" <?= set_select( 'district', $district->id, $profile->district === $district->id ); ?>><?= $district->name ?></option>
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
												<option value="none" <?= set_select( 'education', 'none', $profile->education === 'none' ); ?>>None</option>
												<option value="hs" <?= set_select( 'education', 'hs', $profile->education === 'hs' ); ?>>High School</option>
												<option value="hsc" <?= set_select( 'education', 'hsc', $profile->education === 'hsc' ); ?>>Higher Secondary</option>
												<option value="ug" <?= set_select( 'education', 'ug', $profile->education === 'ug' ); ?>>Graduate</option>
												<option value="pg" <?= set_select( 'education', 'pg', $profile->education === 'pg' ); ?>>Post Graduate</option>
											</select>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group has-feedback">
											<label>Education Details</label>
											<input name="education_details" id="education_details" class="form-control" placeholder="Education details" value="<?= set_value( 'education_details', $profile->education_details ); ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label>Job</label>
											<select class="form-control select2" name="job" id="job" required>
												<option value="">Select job</option>
												<option value="none" <?= set_select( 'job', 'none', $profile->job === 'none' ); ?>>None</option>
												<option value="private" <?= set_select( 'job', 'private', $profile->job === 'private' ); ?>>Private</option>
												<option value="govt" <?= set_select( 'job', 'govt', $profile->job === 'govt' ); ?>>Government</option>
												<option value="business" <?= set_select( 'job', 'business', $profile->job === 'business' ); ?>>Business</option>
											</select>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group has-feedback">
											<label>Job Details</label>
											<input name="job_details" id="job_details" class="form-control" placeholder="Job details" value="<?= set_value( 'job_details', $profile->job_details ); ?>">
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
											<input name="father_name" id="father_name" class="form-control" placeholder="Full name" value="<?= set_value( 'father_name', $profile->father_name ); ?>" required>
											<span class="glyphicon glyphicon-user form-control-feedback"></span>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label>Father's Occupation</label>
											<input name="father_occupation" id="father_occupation" class="form-control" placeholder="Father's occupation" value="<?= set_value( 'father_occupation', $profile->father_occupation ); ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group has-feedback">
											<label>Father's Contact Number</label>
											<input type="number" name="father_number" id="father_number" class="form-control" placeholder="Contact number" value="<?= set_value( 'father_number', $profile->father_number ); ?>" required>
											<span class="glyphicon glyphicon-phone form-control-feedback"></span>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group has-feedback">
											<label>Mother's Name</label>
											<input name="mother_name" id="mother_name" class="form-control" placeholder="Full name" value="<?= set_value( 'mother_name', $profile->mother_name ); ?>">
											<span class="glyphicon glyphicon-user form-control-feedback"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group has-feedback">
											<label>Church Elder Name</label>
											<input name="elder_name" id="elder_name" class="form-control" placeholder="Full name" value="<?= set_value( 'elder_name', $profile->elder_name ); ?>" required>
											<span class="glyphicon glyphicon-user form-control-feedback"></span>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group has-feedback">
											<label>Church Elder Contact Number</label>
											<input type="number" name="elder_number" id="elder_number" class="form-control" placeholder="Contact number" value="<?= set_value( 'elder_number', $profile->elder_number ); ?>" required>
											<span class="glyphicon glyphicon-phone form-control-feedback"></span>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12">
								<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
							</div>
						</div>
						</form>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
	</div>

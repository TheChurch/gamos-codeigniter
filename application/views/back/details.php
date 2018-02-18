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
						<i class="fa fa-table"></i> <span>Profile List</span>
						<span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
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
				Profile Details
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
				<div class="col-xs-12">
					<?php $error = $this->session->flashdata( 'error' ); ?>
					<?php $success = $this->session->flashdata( 'success' ); ?>
					<?php if ( isset( $error ) ) : ?>
						<div class="callout callout-danger">
							<?= $error ?>
						</div>
					<?php elseif ( isset( $success ) ) : ?>
						<div class="callout callout-success">
							<?= $success ?>
						</div>
					<?php endif; ?>
				</div>
				<!-- /.col -->
			</div>
			<div class="row">
				<div class="col-md-3">

					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-body box-profile">
							<?php $pimg = $profile->gender === 'M' ? 'male.png' : 'female.png'; ?>
							<img class="profile-user-img img-responsive img-circle" src="<?= base_url( 'assets/dist/img/' . $pimg ); ?>" alt="User profile picture">

							<h3 class="profile-username text-center"><?= isset( $profile->name ) ? $profile->name : '' ?></h3>

							<p class="text-muted text-center"><?= isset( $profile->church ) ? $profile->church : ''; ?></p>

							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>Age</b> <a class="pull-right"><b><?= isset( $profile->dob ) ? getAge( $profile->dob ) : 'Unknown'; ?></b></a>
								</li>
								<li class="list-group-item">
									<?php $dob = date( 'd-m-Y', strtotime( $profile->dob ) ); ?>
									<b>Date of Birth</b> <a class="pull-right"><b><?= $dob; ?></b></a>
								</li>
								<li class="list-group-item">
									<b>Gender</b> <a class="pull-right"><b><?= isset( $profile->gender ) ? getGender( $profile->gender ) : ''; ?></b></a>
								</li>
								<li class="list-group-item">
									<b>Height</b> <a class="pull-right"><b><?= isset( $profile->height ) ? $profile->height : 'Unknown'; ?> cm</b></a>
								</li>
								<li class="list-group-item">
									<b>Weight</b> <a class="pull-right"><b><?= isset( $profile->weight ) ? $profile->weight : 'Unknowns'; ?> kg</b></a>
								</li>
							</ul>

						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->

					<!-- About Me Box -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Education & Job</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<strong><i class="fa fa-graduation-cap margin-r-5"></i> Education</strong>
							<p class="text-muted"><?= isset( $profile->education ) ? getEducation( $profile->education ) : 'Unknown'; ?><?php empty( $profile->education_details ) ? '' : ' - ' . $profile->education_details; ?></p>
							<hr>
							<strong><i class="fa fa-suitcase margin-r-5"></i> Job</strong>
							<p class="text-muted"><?= isset( $profile->job ) ? getJob( $profile->job ) : 'Unknown'; ?><?php empty( $profile->job_details ) ? '' : ' - ' . $profile->job_details; ?></p>
							<hr>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->

					<!-- About Me Box -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Address</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<strong><i class="fa fa-book margin-r-5"></i> Church</strong>
							<p class="text-muted"><?= isset( $profile->church ) ? $profile->church : 'Unknown'; ?></p>
							<hr>
							<strong><i class="fa fa-map-marker margin-r-5"></i> District</strong>
							<p class="text-muted"><?= isset( $profile->district ) ? $profile->district : 'Unknown'; ?></p>
							<hr>
							<strong><i class="fa fa-map-marker margin-r-5"></i> State</strong>
							<p class="text-muted"><?= isset( $profile->state ) ? $profile->state : 'Unknown'; ?></p>
							<hr>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->

				</div>
				<!-- /.col -->
				<div class="col-md-4">

					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Family & Church Details</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<strong><i class="fa fa-male margin-r-5"></i> Father's Name</strong>
							<p class="text-muted"><?= isset( $profile->father_name ) ? $profile->father_name : ''; ?></p>
							<hr>

							<strong><i class="fa fa-suitcase margin-r-5"></i> Father's Occupation</strong>
							<p class="text-muted"><?= isset( $profile->father_occupation ) ? $profile->father_occupation : ''; ?></p>
							<hr>

							<strong><i class="fa fa-female margin-r-5"></i> Mother's Name</strong>
							<p class="text-muted"><?= isset( $profile->mother_name ) ? $profile->mother_name : ''; ?></p>
							<hr>

							<strong><i class="fa fa-user margin-r-5"></i> Church Elder's Name</strong>
							<p class="text-muted"><?= isset( $profile->elder_name ) ? $profile->elder_name : ''; ?></p>
							<hr>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->

					<!-- About Me Box -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Profile Images</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<?php $img_count = 0; ?>
									<?php if ( ! empty( $images ) ) : ?>
										<?php foreach ( $images as $image ) : ?>
											<?php if ( ! file_exists( realpath( APPPATH . '../uploads/' . $profile->upload_key . '/' . $image ) ) ) : ?>
												<?php continue; ?>
											<?php endif; ?>
											<div class="item <?php echo $img_count === 0 ? 'active' : ''; ?>">
												<img src="<?= base_url( 'uploads/' . $profile->upload_key . '/' . $image ); ?>" alt="First slide">
											</div>
											<?php $img_count++; ?>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
								<?php if ( $img_count > 1 ) : ?>
									<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
										<span class="fa fa-angle-left"></span>
									</a>
									<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
										<span class="fa fa-angle-right"></span>
									</a>
								<?php endif; ?>
								<?php if ( $img_count === 0 ) : ?>
									<p class="text-red">No images found.</p>
								<?php endif; ?>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
	</div>

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
				<li class="treeview">
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
				<li class="treeview active">
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
				Contact Us
				<small>gamos search</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?= base_url( 'dashboard' ); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Contact Us</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-4">

					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Contact Details</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<p>
								For profile corrections and other help, you may contact <strong>Biju Varghese</strong> (Church at Thiruvananthapuram).
							</p>
							<strong><i class="fa fa-phone margin-r-5"></i> 9447360988</strong>
							<p class="text-muted"></p>
							<strong><i class="fa fa-envelope margin-r-5"></i> bijubv@gmail.com</strong>
							<p class="text-muted"></p>
							<hr>
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

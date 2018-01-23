<?php
// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' );
?>
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
					<p>Camp Admin</p>
					<a href="<?= base_url( 'logout' ); ?>"><i class="fa fa-circle text-success"></i> Logout</a>
				</div>
			</div>
			<!-- /.search form -->
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header">Data Reporting</li>
				<li class="treeview">
					<a href="#">
						<i class="fa fa-dashboard"></i> <span>Dashboard</span>
						<span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
					</a>
				</li>
				<li class="treeview active">
					<a href="<?= base_url( 'admin/report' ); ?>">
						<i class="fa fa-table"></i> <span>Attendee Report</span>
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
				Data Reporting
				<small>attendee list</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
				<li class="active">Data reporting</li>
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
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Attendees Filter</h3>
						</div>
						<!-- /.box-header -->
                        <form id="filter_form" action="<?= base_url( 'admin/export' ) ?>" method="post">
                            <div class="box-body">
                                <div class="col-md-9">
                                    <div class="col-xs-4">
                                        <div class="form-group has-feedback">
                                            <label>Name</label>
                                            <input name="name" id="name" class="form-control attendee-filter" placeholder="Full name">
                                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group has-feedback">
                                            <label>Church</label>
                                            <select class="form-control attendee-filter select2" id="church" name="church">
                                                <option value="">Select church</option>
                                                <?php if ( ! empty( $churches ) ) : ?>
                                                    <?php foreach ( $churches as $church ) : ?>
                                                        <option value="<?= $church->id ?>"><?= $church->name ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group has-feedback">
                                            <label>Gender</label>
                                            <select class="form-control attendee-filter select2" id="gender" name="gender">
                                                <option value="">Select gender</option>
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-xs-4">
                                        <div class="form-group has-feedback">
                                            <div class="col-xs-6 no-padding-left">
                                                <label>Age from</label>
                                                <select class="form-control attendee-filter select2" id="age_from" name="age_from">
                                                    <option value="">Select age</option>
                                                    <?php for ( $i = 1; $i <= 120; $i++ ) : ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-6 no-padding-right">
                                                <label>Age to</label>
                                                <select class="form-control attendee-filter select2" id="age_to" name="age_to">
                                                    <option value="">Select age</option>
                                                    <?php for ( $i = 1; $i <= 120; $i++ ) : ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="col-xs-6 no-padding-left">
                                            <div class="form-group has-feedback">
                                                <label>Day</label>
                                                <select class="form-control attendee-filter select2" id="day" name="day">
                                                    <option value="">Select day</option>
                                                    <option value="1">Day 1</option>
                                                    <option value="2">Day 2</option>
                                                    <option value="3">Day 3</option>
                                                    <option value="4">Day 4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 no-padding-right">
                                            <div class="form-group has-feedback">
                                                <label>Time</label>
                                                <select class="form-control attendee-filter select2" id="time" name="time">
                                                    <option value="">Select time</option>
                                                    <option value="breakfast">Breakfast</option>
                                                    <option value="lunch">Lunch</option>
                                                    <option value="tea">Tea</option>
                                                    <option value="supper">Supper</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="form-group has-feedback">
                                            <label>Accommodation</label>
                                            <select class="form-control attendee-filter select2" id="accommodation" name="accommodation">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-2">
                                        <div class="form-group has-feedback">
                                            <label></label>
                                            <button type="button" class="btn btn-block btn-primary" id="export">Export</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3>
                                                <span id="attendees_counts">Profiles</span>
                                            </h3>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            <h3>
                                                <span id="attendees_count">0</span>
                                            </h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
						<!-- /.box-body -->
					</div>
					<div class="box">
						<div class="box-header"></div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="attendees_table" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Church</th>
										<th>Age</th>
										<th>Gender</th>
										<th>Accommodation</th>
                                        <th>Actions</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
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

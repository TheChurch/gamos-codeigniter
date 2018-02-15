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
					<p><?php echo $this->session->userdata( 'username' ) ? 'User' : ucwords( $this->session->userdata( 'username' ) ); ?></p>
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
				Profile List
				<small>gamos search</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="<?= base_url( 'dashboard/profiles' ); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
				<li class="active">Profile List</li>
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
							<h3 class="box-title">Profile Filter</h3>
						</div>
						<!-- /.box-header -->
                        <form id="filter_form">
                            <div class="box-body">
                                <div class="col-md-9">
                                    <div class="col-xs-3">
                                        <div class="form-group has-feedback">
                                            <label>Church</label>
                                            <select class="form-control profile-filter select2" id="church" name="church">
                                                <option value="">Select church</option>
                                                <?php if ( ! empty( $churches ) ) : ?>
                                                    <?php foreach ( $churches as $church ) : ?>
                                                        <option value="<?= $church->id ?>"><?= $church->name ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
	                                <div class="col-xs-3">
		                                <div class="form-group has-feedback">
			                                <label>Gender</label>
			                                <select class="form-control profile-filter select2" id="gender" name="gender">
				                                <option value="">Select gender</option>
				                                <option value="M">Male</option>
				                                <option value="F">Female</option>
			                                </select>
		                                </div>
	                                </div>
	                                <div class="col-xs-3">
		                                <div class="form-group has-feedback">
			                                <label>Age from</label>
			                                <select class="form-control profile-filter select2" id="age_from" name="age_from">
				                                <option value="">Select age</option>
				                                <?php for ( $i = 1; $i <= 50; $i++ ) : ?>
					                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				                                <?php endfor; ?>
			                                </select>
		                                </div>
	                                </div>
	                                <div class="col-xs-3">
		                                <div class="form-group has-feedback">
			                                <label>Age to</label>
			                                <select class="form-control profile-filter select2" id="age_to" name="age_to">
				                                <option value="">Select age</option>
				                                <?php for ( $i = 1; $i <= 50; $i++ ) : ?>
					                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				                                <?php endfor; ?>
			                                </select>
		                                </div>
	                                </div>
                                    <div class="clearfix"></div>
	                                <div class="col-xs-3">
		                                <div class="form-group has-feedback">
			                                <label>State</label>
			                                <select class="form-control profile-filter select2" id="state" name="state">
				                                <option value="">Select state</option>
				                                <?php if ( ! empty( $states ) ) : ?>
					                                <?php foreach ( $states as $state ) : ?>
						                                <option value="<?= $state->id ?>"><?= $state->name ?></option>
					                                <?php endforeach; ?>
				                                <?php endif; ?>
			                                </select>
		                                </div>
	                                </div>
	                                <div class="col-xs-3">
		                                <div class="form-group has-feedback">
			                                <label>District</label>
			                                <select class="form-control profile-filter select2" id="district" name="district">
				                                <option value="">Select district</option>
				                                <?php if ( ! empty( $districts ) ) : ?>
					                                <?php foreach ( $districts as $district ) : ?>
						                                <option value="<?= $district->id ?>"><?= $district->name ?></option>
					                                <?php endforeach; ?>
				                                <?php endif; ?>
			                                </select>
		                                </div>
	                                </div>
	                                <div class="col-xs-3">
		                                <div class="form-group has-feedback">
			                                <label>Education</label>
			                                <select class="form-control profile-filter select2" id="education" name="education">
				                                <option value="">Select education</option>
				                                <?php if ( ! empty( $educations ) ) : ?>
					                                <?php foreach ( $educations as $education ) : ?>
						                                <option value="<?= $education->id ?>"><?= $education->name ?></option>
					                                <?php endforeach; ?>
				                                <?php endif; ?>
			                                </select>
		                                </div>
	                                </div>
	                                <div class="col-xs-3">
		                                <div class="form-group has-feedback">
			                                <label>Job</label>
			                                <select class="form-control profile-filter select2" id="job" name="job">
				                                <option value="">Select job</option>
				                                <?php if ( ! empty( $jobs ) ) : ?>
					                                <?php foreach ( $jobs as $job ) : ?>
						                                <option value="<?= $job->id ?>"><?= $job->name ?></option>
					                                <?php endforeach; ?>
				                                <?php endif; ?>
			                                </select>
		                                </div>
	                                </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="small-box bg-green">
                                        <div class="inner">
                                            <h3>
                                                <span id="profile_counts">Profiles</span>
                                            </h3>
                                        </div>
                                        <a href="#" class="small-box-footer">
                                            <h3>
                                                <span id="profile_count">0</span>
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
							<table id="profiles_table" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Image</th>
										<th>Name</th>
										<th>Gender</th>
										<th>Age</th>
										<th>Church</th>
										<th>Education</th>
										<th>Job</th>
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

<div class="register-box" xmlns="http://www.w3.org/1999/html">
	<div class="register-logo">
		<a href="javascript:void(0);"><b>Attendee</b> Registration</a>
	</div>

	<?php $error = $this->session->flashdata( 'error' ); ?>
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

		<p class="login-box-msg">Register an attendee ( <a href="<?= base_url( 'logout' ) ?>"><b>Logout</b></a> )</p>

		<?= form_open( 'registration/register' ) ?>
			<div class="box-group" id="accordion">
				<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Attendee Details</h3>
					</div>
						<div class="box-body">
							<div class="row">
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
								<div class="col-xs-6">
									<div class="form-group has-feedback">
										<label>Name</label>
										<input name="name" id="name" class="form-control" placeholder="Full name" value="<?= set_value( 'name' ); ?>" required>
										<span class="glyphicon glyphicon-user form-control-feedback"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">
										<label>Age</label>
										<input type="number" name="age" id="age" min="1" max="120" class="form-control" placeholder="Age" value="<?= set_value( 'age' ); ?>" required>
										<span class="glyphicons glyphicons-uk-rat-18 form-control-feedback"></span>
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group has-feedback">
										<label>Gender</label><br/>
										<input type="radio" name="gender" value="M" class="flat-red" <?php echo set_radio( 'gender', 'M', true ); ?>> Male
										<input type="radio" name="gender" value="F" class="flat-red"  <?php echo set_radio( 'gender', 'F' ); ?>> Female
									</div>
								</div>
								<div class="col-xs-3">
									<div class="form-group has-feedback">
										<label>Accommodation</label><br>
										<input type="checkbox" id="accommodation" name="accommodation" value="1" class="flat-red" checked> Yes, required.
									</div>
								</div>
							</div>
						</div>
				</div>
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Dates and Time</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table class="table table-bordered">
							<tr>
								<th><label><input type="checkbox" name="all_days" id="all_days" value="1" class="all_days"> All days</label></th>
								<th>Breakfast</th>
								<th>Lunch</th>
								<th>Tea</th>
								<th>Supper</th>
							</tr>
							<tr>
								<td>
									<label><input type="checkbox" name="day[1][available]" id="day1" value="1" class="day <?= $dates[1] ?>" <?= $dates[1] ?>> Day 1</label>
								</td>
								<td></td>
								<td></td>
								<td></td>
								<td><input type="checkbox" name="day[1][supper]" value="1" class="day1 <?= $dates[1] ?>" disabled></td>
							</tr>
							<tr>
								<td>
									<label><input type="checkbox" name="day[2][available]" id="day2" value="1" class="day <?= $dates[2] ?>" <?= $dates[2] ?>> Day 2</label>
								</td>
								<td><input type="checkbox" name="day[2][breakfast]" value="1" class="day2 <?= $dates[2] ?>" disabled></td>
								<td><input type="checkbox" name="day[2][lunch]" value="1" class="day2 <?= $dates[2] ?>" disabled></td>
								<td><input type="checkbox" name="day[2][tea]" value="1" class="day2 <?= $dates[2] ?>" disabled></td>
								<td><input type="checkbox" name="day[2][supper]" value="1" class="day2 <?= $dates[2] ?>" disabled></td>
							</tr>
							<tr>
								<td>
									<label><input type="checkbox" name="day[3][available]" id="day3" value="1" class="day <?= $dates[3] ?>" <?= $dates[3] ?>> Day 3</label>
								</td>
								<td><input type="checkbox" name="day[3][breakfast]" value="1" class="day3 <?= $dates[3] ?>" disabled></td>
								<td><input type="checkbox" name="day[3][lunch]" value="1" class="day3 <?= $dates[3] ?>" disabled></td>
								<td><input type="checkbox" name="day[3][tea]" value="1" class="day3 <?= $dates[3] ?>" disabled></td>
								<td><input type="checkbox" name="day[3][supper]" value="1" class="day3 <?= $dates[3] ?>" disabled></td>
							</tr>
							<tr>
								<td>
									<label><input type="checkbox" name="day[4][available]" id="day4" value="1" class="day <?= $dates[4] ?>" <?= $dates[4] ?>> Day 4</label>
								</td>
								<td><input type="checkbox" name="day[4][breakfast]" value="1" class="day4 <?= $dates[4] ?>" disabled></td>
								<td><input type="checkbox" name="day[4][lunch]" value="1" class="day4 <?= $dates[4] ?>" disabled></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
					</div>
				</div>
		</form>
	</div>

	</div>
<!-- /.form-box -->
</div>
<!-- /.register-box -->
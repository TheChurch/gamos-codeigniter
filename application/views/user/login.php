<?php

// If accessed directly, Amen.
defined( 'BASEPATH' ) or exit( 'God bless you!' ); ?>

<div class="login-box login-box-small">
	<div class="login-logo">
		<a href="#"><b>Camp</b> Registration</a>
	</div>

	<?php $error = $this->session->flashdata( 'error' ); ?>
	<?php if ( isset( $error ) ) : ?>
		<div class="callout callout-danger">
			<?= $error ?>
		</div>
	<?php endif; ?>

	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Sign in using your credentials</p>

		<?= form_open( 'validate' ) ?>
			<div class="form-group has-feedback">
				<input class="form-control" id="username" name="username" placeholder="Your username" required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" id="password" name="password" placeholder="Your password" required>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<!-- /.col -->
				<div class="col-xs-12 float-left">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
				<!-- /.col -->
			</div>
		</form>
	</div>
	<!-- /.login-box-body -->
</div>
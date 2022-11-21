<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg">

<head>
	<meta charset="utf-8" />
	<title>Reset Password | Dashboard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="" name="description" />
	<link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.png">
	<script src="<?= base_url() ?>/assets/js/layout.js"></script>
	<link href="<?= base_url() ?>/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
	<link href="<?= base_url() ?>/assets/css/custom.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>

	<div class="auth-page-wrapper pt-5">
		<!-- auth page bg -->
		<div class="auth-one-bg-position auth-one-bg">
			<div class="bg-overlay"></div>

			<div class="shape">
				<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
					<path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
				</svg>
			</div>
		</div>

		<!-- auth page content -->
		<div class="auth-page-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="text-center mt-sm-5 mb-2 text-white-50">
							<div>
								<a href="<?= base_url() ?>" class="d-inline-block auth-logo">
									<img src="<?= base_url() ?>/assets/images/logo-dark.png" alt="" height="40">
								</a>
							</div>
							<!-- <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p> -->
						</div>
					</div>
				</div>
				<!-- end row -->

				<div class="row justify-content-center">
					<div class="col-md-8 col-lg-6 col-xl-5">
						<div class="card mt-4 card-login">

							<div class="card-body">
								<div class="text-center mt-2">
									<h5 class="color-green">Reiniciar contraseña</h5>
									<div id="infoMessage"><?php echo $message; ?></div>
								</div>
								<div class="p-2 mt-4">
									<form action="<?= base_url('auth/reset_password/' . $code) ?>" method="post" accept-charset="utf-8" class="form-soaga">
									<?= csrf_field() ?>

										<div class="mb-3">
											<label class="form-label" for="password-input">Nueva contraseña</label>
											<div class="position-relative auth-pass-inputgroup mb-3">
												<input type="password" class="form-control pe-5" placeholder="Nueva Contraseña" id="password-input" name="new" tabindex="1">
												<button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
											</div>
										</div>

										<div class="mb-3">
											<label class="form-label" for="password-input-confirm">Confirmar nueva contraseña</label>
											<div class="position-relative auth-pass-inputgroup mb-3">
												<input type="password" class="form-control pe-5" placeholder="Confirmar Nueva Contraseña" id="password-input-confirm" name="new_confirm" tabindex="1">
												<button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon-confirm"><i class="ri-eye-fill align-middle"></i></button>
											</div>
										</div>

										<div class="mt-4">
											<button class="btn btn-black w-100" type="submit" tabindex="3">Envíar</button>
										</div>


									</form>
								</div>
							</div>
							<!-- end card body -->
						</div>
						<!-- end card -->

					</div>
				</div>
				<!-- end row -->
			</div>
			<!-- end container -->
		</div>
		<!-- end auth page content -->

		<!-- footer -->
		<footer class="footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="text-center">
							<p class="mb-0 text-muted"></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- end Footer -->
	</div>
	<!-- end auth-page-wrapper -->

	<!-- JAVASCRIPT -->
	<script src="<?= base_url() ?>/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>/assets/libs/simplebar/simplebar.min.js"></script>
	<script src="<?= base_url() ?>/assets/libs/node-waves/waves.min.js"></script>
	<script src="<?= base_url() ?>/assets/libs/feather-icons/feather.min.js"></script>
	<script src="<?= base_url() ?>/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
	<script src="<?= base_url() ?>/assets/js/plugins.js"></script>

	<!-- particles js -->
	<script src="<?= base_url() ?>/assets/libs/particles.js/particles.js"></script>
	<!-- particles app js -->
	<script src="<?= base_url() ?>/assets/js/pages/particles.app.js"></script>
	<!-- password-addon init -->
	<script src="<?= base_url() ?>/assets/js/pages/password-addon.init.js"></script>
</body>

</html>
<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic | Bootstrap HTML, VueJS, React, Angular, Asp.Net Core, Blazor, Django, Flask & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
	<base href="../../../" />
	<title>Beone Project</title>
	<meta charset="utf-8" />
	<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Blazor, Django, Flask & Laravel versions. Grab your copy now and get life-time updates for free." />
	<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Blazor, Django, Flask & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Metronic | Bootstrap HTML, VueJS, React, Angular, Asp.Net Core, Blazor, Django, Flask & Laravel Admin Dashboard Theme" />
	<meta property="og:url" content="https://keenthemes.com/metronic" />
	<meta property="og:site_name" content="Keenthemes | Metronic" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
	<link rel="shortcut icon" href="{{url('assets/media/logos/favicon.ico')}}" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Stylesheets Bundle(used by all pages)-->
	<link href="{{url('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{url('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
	<!--end::Global Stylesheets Bundle-->

	<style>
		input:focus {
			border: 3px solid #000000;
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
		}

		.text-gray-700 {
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
		}

		.text-dark {
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
		}

		.text-white {
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
		}

		.btn-custom-purple {
			font-family: 'Poppins', 'Inter', Helvetica, sans-serif;
			background: rgb(139, 133, 221);
			background: linear-gradient(333deg, rgba(139, 133, 221, 1) 0%, rgba(181, 143, 233, 1) 78%);
			color: white;
		}

		.btn-custom-purple:hover {
			background: rgb(139, 133, 221);
			background: linear-gradient(301deg, rgba(139, 133, 221, 1) 8%, rgba(178, 149, 218, 1) 72%);
		}
	</style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
	<!--begin::Theme mode setup on page load-->
	<script>
		var defaultThemeMode = "light";
		var themeMode;
		if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-theme-mode");
			} else {
				if (localStorage.getItem("data-theme") !== null) {
					themeMode = localStorage.getItem("data-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}
			if (themeMode === "system") {
				themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
			}
			document.documentElement.setAttribute("data-theme", themeMode);
		}
	</script>
	<!--end::Theme mode setup on page load-->
	<!--begin::Main-->
	<!--begin::Root-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="page d-flex flex-row flex-column-fluid" style="padding-top:20px;">
			<!--begin::Wrapper-->
			<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
				<!--begin::Aside-->
				<div class="d-flex flex-center flex-column">
					<!--begin::Logo-->
					<a href="#" class="mb-3">
						<img alt="Logo" width="160" src="{{url('assets/media/logos/demo2.png')}}" />
					</a>
					<!--end::Logo-->
					<!--begin::Title-->
					<h3 class="text-white fw-normal m-0">Welcome to Beone Project Environment System.</h3>
					<!--end::Title-->
				</div>
				<!--begin::Aside-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->


		<!--begin::Page bg image-->
		<style>
			body {
				background-image: url("{{url('assets/media/auth/bg2.jpg')}}");
			}

			[data-theme="dark"] body {
				background-image: url("{{url('assets/media/auth/bg4-dark.jpg')}}");
			}
		</style>
		<!--end::Page bg image-->
		<!--begin::Authentication - Sign-in -->
		<div class="d-flex flex-column flex-column-fluid flex-lg-row">
			<!--begin::Body-->
			<div class="d-flex flex-center w-lg-100 p-10">
				<!--begin::Card-->
				<div class="card rounded-3 w-md-550px" style="background-color: rgba(255, 255, 255, 0.5);
																	border-radius: 10px;
																	box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);">
					<!--begin::Card body-->
					<div class="card-body p-10 p-lg-20">
						<!--begin::Form-->
						<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" name="kt_sign_in_form" action="/dologin" method="POST">
							@csrf <!-- Add @csrf here -->
							<!--begin::Heading-->
							<div class="text-center mb-11">
								<!--begin::Title-->
								<h1 class="text-dark fw-bolder mb-3">Silahkan Login</h1>
								<!--end::Title-->
								<!--begin::Subtitle-->
								<div class="text-gray-700 fw-semibold fs-6">Apabila belum memiliki user atau mengalami kendala login bisa menghubungi admin.</div>
								<!--end::Subtitle=-->
							</div>
							<!--begin::Heading-->

							<!--begin::Input group=-->
							<div class="fv-row mb-8">
								<!--begin::Username-->
								<input type="text" placeholder="Username" name="username" id="username" autocomplete="off" class="form-control bg-transparent" style="border-color: #b3b3b3;" required />
								<!--end::Username-->
							</div>
							<!--end::Input group=-->
							<div class="fv-row mb-3">
								<!--begin::Password-->
								<input type="password" placeholder="password" name="password" id="password" autocomplete="off" class="form-control bg-transparent" style="border-color: #b3b3b3;" required />
								<!--end::Password-->
							</div>
							<!--end::Input group=-->

							<!--begin::Submit button-->
							<div class="d-grid mb-10">
								<button type="button" class="btn btn-custom-purple" data-kt-userslogin-modal-action="submit" id="kt_sign_in_submit">
									<!--begin::Indicator label-->
									<span class="indicator-label">Login</span>
									<!--end::Indicator label-->
									<!--begin::Indicator progress-->
									<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									<!--end::Indicator progress-->
								</button>
							</div>
							<!--end::Submit button-->
						</form>

					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
			</div>
			<!--end::Body-->
		</div>
		<!--end::Authentication - Sign-in-->
	</div>




	<!--end::Root-->
	<!--end::Main-->
	<!--begin::Javascript-->
	<script>
		var hostUrl = "assets/";
	</script>
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="{{url('assets/plugins/global/plugins.bundle.js')}}"></script>
	<script src="{{url('assets/js/scripts.bundle.js')}}"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Custom Javascript(used by this page)-->
	<script src="{{url('assets/js/url.js')}}"></script>
	<script src="{{url('assets/js/custom/authentication/sign-in/validation_login.js')}}"></script>
	<!--end::Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>
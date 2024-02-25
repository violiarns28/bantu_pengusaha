import 'package:get/get.dart';

import '../modules/clock_in/acc_clock_in/bindings/acc_clock_in_binding.dart';
import '../modules/clock_in/acc_clock_in/views/acc_clock_in_view.dart';
import '../modules/clock_in/bindings/attendance_binding.dart';
import '../modules/clock_in/views/clock_in_view.dart';
import '../modules/clock_out/bindings/clock_out_binding.dart';
import '../modules/clock_out/views/clock_out_view.dart';
import '../modules/home/bindings/home_binding.dart';
import '../modules/home/views/home_view.dart';
import '../modules/login/bindings/login_binding.dart';
import '../modules/login/views/login_view.dart';
import '../modules/splash/bindings/splash_binding.dart';
import '../modules/splash/views/splash_view.dart';

part 'app_routes.dart';

class AppPages {
  AppPages._();

  static const INITIAL = Routes.SPLASH;

  static final routes = [
    GetPage(
      name: _Paths.HOME,
      page: () => const HomeView(),
      binding: HomeBinding(),
    ),
    GetPage(
      name: _Paths.SPLASH,
      page: () => const SplashView(),
      binding: SplashBinding(),
    ),
    GetPage(
      name: _Paths.LOGIN,
      page: () => const LoginView(),
      binding: LoginBinding(),
    ),
    GetPage(
      name: _Paths.CLOCK_OUT,
      page: () => const ClockOutView(),
      binding: ClockOutBinding(),
    ),
    GetPage(
      name: _Paths.CLOCK_IN,
      page: () => const ClockInView(),
      binding: ClockInBinding(),
      children: [
        GetPage(
          name: _Paths.ACC_CLOCK_IN,
          page: () => const AccClockInView(),
          binding: AccClockInBinding(),
        ),
      ],
    ),
  ];
}

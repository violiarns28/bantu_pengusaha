part of 'app_pages.dart';

abstract class Routes {
  Routes._(); // Konstruktor privat untuk mencegah instansiasi kelas ini secara tidak sengaja

  // Definisi konstanta-konstanta rute
  static const HOME = _Paths.HOME;
  static const SPLASH = _Paths.SPLASH;
  static const LOGIN = _Paths.LOGIN;
  static const ATTENDANCE = _Paths.ATTENDANCE;
  static const CLOCK_OUT = _Paths.CLOCK_OUT;
  static const CLOCK_IN = _Paths.CLOCK_IN;
  static const PROFILE = _Paths.PROFILE;
  static const BOTTOM_NAV_BAR = _Paths.BOTTOM_NAV_BAR;
}

abstract class _Paths {
  _Paths._(); // Konstruktor privat untuk mencegah instansiasi kelas ini secara tidak sengaja

  // Definisi string rute
  static const HOME = '/home';
  static const SPLASH = '/splash';
  static const LOGIN = '/login';
  static const ATTENDANCE = '/attendance';
  static const CLOCK_OUT = '/clock-out';
  static const CLOCK_IN = '/clock-in';
  static const PROFILE = '/profile';
  static const BOTTOM_NAV_BAR = '/bottom-nav-bar';
}

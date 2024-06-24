import 'package:bantu_pengusaha/modules/modules.dart'; // Mengimpor modul-modul aplikasi
import 'package:get/get.dart'; // Mengimpor GetX library untuk manajemen state dan navigasi

part 'app_routes.dart'; // Mengimpor file app_routes.dart yang berisi definisi rute

class AppPages {
  AppPages._(); // Konstruktor privat untuk mencegah instansiasi kelas ini secara tidak sengaja

  static const INITIAL = Routes.SPLASH; // Konstanta untuk rute awal aplikasi

  static final routes = [
    // List dari GetPage untuk setiap halaman dalam aplikasi
    GetPage(
      name: _Paths.HOME, // Nama rute
      page: () => const HomeView(), // Widget untuk halaman Home
      binding: HomeBinding(), // Binding untuk HomeView
    ),
    GetPage(
      name: _Paths.SPLASH, // Nama rute
      page: () => const SplashView(), // Widget untuk halaman Splash
      binding: SplashBinding(), // Binding untuk SplashView
    ),
    GetPage(
      name: _Paths.LOGIN, // Nama rute
      page: () => const LoginView(), // Widget untuk halaman Login
      binding: LoginBinding(), // Binding untuk LoginView
    ),
    GetPage(
      name: _Paths.PROFILE, // Nama rute
      page: () => const ProfileView(), // Widget untuk halaman Profile
      binding: ProfileBinding(), // Binding untuk ProfileView
    ),
    GetPage(
      name: _Paths.BOTTOM_NAV_BAR, // Nama rute
      page: () => const BottomNavBarView(), // Widget untuk halaman BottomNavBar
      binding: BottomNavBarBinding(), // Binding untuk BottomNavBarView
    ),
    GetPage(
      name: _Paths.ATTENDANCE, // Nama rute
      page: () => const AttendanceView(), // Widget untuk halaman Attendance
      binding: AttendanceBinding(), // Binding untuk AttendanceView
    ),
  ];
}

import 'package:bantu_pengusaha/core/routes/routes.dart'; // Mengimpor definisi rute aplikasi
import 'package:bantu_pengusaha/core/services/location.dart'; // Mengimpor layanan lokasi
import 'package:bantu_pengusaha/data/repo/auth/auth.dart'; // Mengimpor repositori autentikasi
import 'package:get/get.dart'; // Mengimpor GetX library untuk manajemen state dan navigasi

class SplashController extends GetxController {
  final AuthRepo _authRepo; // Instance dari AuthRepo untuk operasi autentikasi
  final LocationService
      _locationService; // Instance dari LocationService untuk operasi lokasi

  SplashController(
    this._authRepo,
    this._locationService,
  );

  @override
  void onReady() async {
    super.onReady();

    // Meminta izin lokasi
    bool isOk = await _locationService.requestPermission();

    // Memanggil endpoint "me" untuk mendapatkan info pengguna saat aplikasi siap
    final me = await _authRepo.me();

    // Delay 3 detik sebelum navigasi ke halaman selanjutnya
    Future.delayed(const Duration(seconds: 3), () async {
      if (isOk) {
        // Jika izin lokasi diberikan dan pengguna terautentikasi, navigasi ke halaman BOTTOM_NAV_BAR
        if (me.success) {
          Get.offAllNamed(Routes.BOTTOM_NAV_BAR);
        }
        // Jika izin lokasi diberikan tetapi pengguna tidak terautentikasi, navigasi ke halaman LOGIN
        else {
          Get.offAllNamed(Routes.LOGIN);
        }
      } else {
        // Jika izin lokasi tidak diberikan, tampilkan snackbar dengan pesan informasi
        Get.snackbar('Location permission required',
            "To use this app please allow location permission");

        // Meminta izin lokasi kembali
        isOk = await _locationService.requestPermission();

        // Delay 3 detik sebelum navigasi ke halaman selanjutnya
        Future.delayed(const Duration(seconds: 3), () {
          if (me.success) {
            Get.offAllNamed(Routes.BOTTOM_NAV_BAR);
          } else {
            Get.offAllNamed(Routes.LOGIN);
          }
        });
      }
    });
  }
}

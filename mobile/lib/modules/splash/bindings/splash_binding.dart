import 'package:bantu_pengusaha/core/services/location.dart'; // Mengimpor layanan lokasi yang diperlukan
import 'package:bantu_pengusaha/data/repo/auth/auth_repo_impl.dart'; // Mengimpor implementasi repositori autentikasi
import 'package:get/get.dart'; // Mengimpor GetX library untuk manajemen state dan navigasi

import '../controllers/splash_controller.dart'; // Mengimpor controller SplashController

class SplashBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<SplashController>(
      () => SplashController(
        Get.find<
            AuthRepoImpl>(), // Mendapatkan instance AuthRepoImpl dari GetX untuk injeksi dependensi ke SplashController
        Get.find<
            LocationService>(), // Mendapatkan instance LocationService dari GetX untuk injeksi dependensi ke SplashController
      ),
    );
  }
}

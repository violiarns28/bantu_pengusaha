import 'package:bantu_pengusaha/core/services/services.dart'; // Mengimpor layanan-layanan yang diperlukan
import 'package:bantu_pengusaha/data/repo/auth/auth.dart'; // Mengimpor repositori AuthRepoImpl
import 'package:get/get.dart'; // Mengimpor GetX library

import '../controllers/login_controller.dart'; // Mengimpor LoginController yang akan di-bind

class LoginBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<LoginController>(
      () => LoginController(
        Get.find<
            AuthRepoImpl>(), // Mendapatkan instance AuthRepoImpl dari GetX untuk injeksi ke LoginController
        Get.find<
            LocationService>(), // Mendapatkan instance LocationService dari GetX untuk injeksi ke LoginController
      ),
    );
  }
}

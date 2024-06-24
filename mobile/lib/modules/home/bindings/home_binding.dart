import 'package:bantu_pengusaha/core/services/services.dart'; // Mengimpor layanan yang diperlukan
import 'package:bantu_pengusaha/data/repo/attendance/attendance.dart'; // Mengimpor repositori yang diperlukan
import 'package:get/get.dart'; // Mengimpor Get untuk manajemen status

import '../controllers/home_controller.dart'; // Mengimpor HomeController yang akan diinisialisasi

class HomeBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<HomeController>(
      () => HomeController(
        Get.find<
            AttendanceRepoImpl>(), // Mendapatkan instance AttendanceRepoImpl dari GetX
        Get.find<LocalService>(), // Mendapatkan instance LocalService dari GetX
        Get.find<
            LocationService>(), // Mendapatkan instance LocationService dari GetX
      ),
    );
  }
}

import 'package:bantu_pengusaha/core/services/location.dart'; // Mengimpor LocationService untuk layanan lokasi
import 'package:bantu_pengusaha/data/repo/repo.dart'; // Mengimpor repositori yang diperlukan
import 'package:get/get.dart'; // Mengimpor Get untuk manajemen status

import '../controllers/attendance_controller.dart'; // Mengimpor AttendanceController untuk mengikat kontroler

class AttendanceBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<AttendanceController>(
      () => AttendanceController(
        Get.find<
            AttendanceRepoImpl>(), // Mendapatkan instance AttendanceRepoImpl
        Get.find<LocationService>(), // Mendapatkan instance LocationService
        Get.find<GeneralRepoImpl>(), // Mendapatkan instance GeneralRepoImpl
      ),
    );
  }
}

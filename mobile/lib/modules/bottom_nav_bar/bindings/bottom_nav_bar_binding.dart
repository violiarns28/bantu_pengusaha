import 'package:bantu_pengusaha/core/services/services.dart'; // Mengimpor berbagai layanan yang diperlukan
import 'package:bantu_pengusaha/data/repo/repo.dart'; // Mengimpor berbagai repositori yang diperlukan
import 'package:bantu_pengusaha/modules/modules.dart'; // Mengimpor berbagai modul atau bagian aplikasi
import 'package:get/get.dart'; // Mengimpor Get untuk manajemen status

class BottomNavBarBinding extends Bindings {
  @override
  void dependencies() {
    final attendanceRepo = Get.find<
        AttendanceRepoImpl>(); // Mendapatkan instance AttendanceRepoImpl
    final localService =
        Get.find<LocalService>(); // Mendapatkan instance LocalService
    final locationService =
        Get.find<LocationService>(); // Mendapatkan instance LocationService
    final generalRepo =
        Get.find<GeneralRepoImpl>(); // Mendapatkan instance GeneralRepoImpl

    Get.lazyPut<BottomNavBarController>(
      () => BottomNavBarController(), // Menginisialisasi BottomNavBarController
    );
    Get.lazyPut<HomeController>(
      () => HomeController(
        attendanceRepo,
        localService,
        locationService,
      ), // Menginisialisasi HomeController dengan dependensi yang diperlukan
    );
    Get.lazyPut<AttendanceController>(
      () => AttendanceController(
        attendanceRepo,
        locationService,
        generalRepo,
      ), // Menginisialisasi AttendanceController dengan dependensi yang diperlukan
    );
    Get.lazyPut<ProfileController>(
      () => ProfileController(
        Get.find<AuthRepoImpl>(),
        localService,
      ), // Menginisialisasi ProfileController dengan dependensi yang diperlukan
    );
  }
}

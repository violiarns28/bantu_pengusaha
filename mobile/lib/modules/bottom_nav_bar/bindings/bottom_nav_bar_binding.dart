import 'package:bantu_pengusaha/core/services/services.dart';
import 'package:bantu_pengusaha/data/repo/repo.dart';
import 'package:bantu_pengusaha/modules/modules.dart';
import 'package:get/get.dart';

class BottomNavBarBinding extends Bindings {
  @override
  void dependencies() {
    final attendenceRepo = Get.find<AttendanceRepoImpl>;
    final localService = Get.find<LocalService>;
    final locationService = Get.find<LocationService>;
    final generalRepo = Get.find<GeneralRepoImpl>;

    Get.lazyPut<BottomNavBarController>(
      () => BottomNavBarController(),
    );
    Get.lazyPut<HomeController>(
      () => HomeController(
        attendenceRepo(),
        localService(),
        locationService(),
      ),
    );
    Get.lazyPut<AttendanceController>(
      () => AttendanceController(
        attendenceRepo(),
        locationService(),
        generalRepo(),
      ),
    );
    Get.lazyPut<ProfileController>(
      () => ProfileController(
        Get.find<AuthRepoImpl>(),
        localService(),
      ),
    );
  }
}

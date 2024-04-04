import 'package:bantu_pengusaha/core/services/services.dart';
import 'package:bantu_pengusaha/data/repo/attendance/attendance.dart';
import 'package:get/get.dart';

import '../controllers/home_controller.dart';

class HomeBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<HomeController>(
      () => HomeController(
        Get.find<AttendanceRepoImpl>(),
        Get.find<LocalService>(),
        Get.find<LocationService>(),
      ),
    );
  }
}

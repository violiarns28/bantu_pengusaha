import 'package:bantu_pengusaha/core/services/location.dart';
import 'package:bantu_pengusaha/data/repo/repo.dart';
import 'package:get/get.dart';

import '../controllers/attendance_controller.dart';

class AttendanceBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<AttendanceController>(
      () => AttendanceController(
        Get.find<AttendanceRepoImpl>(),
        Get.find<LocationService>(),
        Get.find<GeneralRepoImpl>(),
      ),
    );
  }
}

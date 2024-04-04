import 'package:bantu_pengusaha/core/services/services.dart';
import 'package:bantu_pengusaha/data/repo/repo.dart';
import 'package:get/get.dart';

export './attendance/attendance.dart';
export './auth/auth.dart';

void initRepo() {
  final lS = Get.find<LocalService>;
  Get.lazyPut(
    () => AuthRepoImpl(lS()),
  );
  Get.lazyPut(
    () => AttendanceRepoImpl(lS()),
  );
}

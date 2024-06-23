import 'package:bantu_pengusaha/core/services/services.dart';
import 'package:bantu_pengusaha/data/repo/repo.dart';
import 'package:get/get.dart';

export './attendance/attendance.dart';
export './auth/auth.dart';
export './general/general.dart';

/// Inisialisasi repositori yang dibutuhkan oleh aplikasi
void initRepo() {
  // Mendapatkan instance dari LocalService menggunakan GetX
  final lS = Get.find<LocalService>;

  // Menambahkan AuthRepoImpl ke GetX dengan lazy initialization
  Get.lazyPut(() => AuthRepoImpl(lS()));

  // Menambahkan AttendanceRepoImpl ke GetX dengan lazy initialization
  Get.lazyPut(() => AttendanceRepoImpl(lS()));

  // Menambahkan GeneralRepoImpl ke GetX dengan lazy initialization
  Get.lazyPut(() => GeneralRepoImpl(lS()));
}

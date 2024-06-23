import 'package:bantu_pengusaha/core/services/services.dart';
import 'package:bantu_pengusaha/utils/logger.dart';
import 'package:get/get.dart';

export 'local.dart';
export 'location.dart';

/// Inisialisasi layanan yang diperlukan oleh aplikasi
void initServices() async {
  // Log untuk menunjukkan bahwa inisialisasi layanan dimulai
  log.d('Initialize Service... 🚀');

  // Inisialisasi layanan lokal secara asinkron
  await Get.putAsync(() => LocalService().init());

  // Inisialisasi layanan lokasi secara asinkron
  await Get.putAsync(() => LocationService().init());

  // Log untuk menunjukkan bahwa inisialisasi layanan selesai
  log.d('Finish Initialize Service... ✅');
}

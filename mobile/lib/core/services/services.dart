import 'package:bantu_pengusaha/core/services/services.dart';
import 'package:bantu_pengusaha/utils/logger.dart';
import 'package:get/get.dart';

export 'local.dart';
export 'location.dart';

void initServices() async {
  log.d('Initialize Service... 🚀');

  // Local service
  await Get.putAsync(() => LocalService().init());
  await Get.putAsync(() => LocationService().init());

  log.d('Finish Initialize Service... ✅');
}

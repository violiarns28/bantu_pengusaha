import 'package:get/get.dart';

import '../controllers/acc_clock_in_controller.dart';

class AccClockInBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<AccClockInController>(
      () => AccClockInController(),
    );
  }
}

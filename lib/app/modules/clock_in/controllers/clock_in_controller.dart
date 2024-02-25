import 'package:bantu_pengusaha/app/routes/app_pages.dart';
import 'package:get/get.dart';

class ClockInController extends GetxController {
  //TODO: Implement ClockInController

  final count = 0.obs;
  @override
  void onInit() {
    super.onInit();
  }

  void onReady() {
    Future.delayed(const Duration(seconds: 3), () {
      Get.offAllNamed(Routes.CLOCK_OUT);
    });
    super.onReady();
  }

  @override
  void onClose() {
    super.onClose();
  }

  void increment() => count.value++;
}

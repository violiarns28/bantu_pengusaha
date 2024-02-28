import 'package:get/get.dart';

class ClockInController extends GetxController {
  //TODO: Implement ClockInController

  final count = 0.obs;
  @override
  void onInit() {
    super.onInit();
  }

  void onReady() {
    // Future.delayed(const Duration(seconds: 3), () {
    //   Get.offAllNamed(Routes.PROFILE);
    // });
    super.onReady();
  }

  @override
  void onClose() {
    super.onClose();
  }

  void increment() => count.value++;
}

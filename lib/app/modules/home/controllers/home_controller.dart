import 'package:bantu_pengusaha/app/routes/app_pages.dart';
import 'package:get/get.dart';

class HomeController extends GetxController {
  //TODO: Implement HomeController

  final count = 0.obs;
  @override
  void onInit() {
    super.onInit();
  }

  void onReady() {
    Future.delayed(const Duration(seconds: 3), () {
      Get.offAllNamed(Routes.CLOCK_IN);
    });
    super.onReady();
  }

  @override
  void onClose() {
    super.onClose();
  }

  void increment() => count.value++;
}

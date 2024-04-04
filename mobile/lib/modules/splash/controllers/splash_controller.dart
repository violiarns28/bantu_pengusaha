import 'package:bantu_pengusaha/core/routes/routes.dart';
import 'package:get/get.dart';

class SplashController extends GetxController {
  final count = 0.obs;

  @override
  void onReady() {
    super.onReady();
    Future.delayed(const Duration(seconds: 3), () {
      Get.offAllNamed(Routes.LOGIN);
    });
  }

  void increment() => count.value++;
}

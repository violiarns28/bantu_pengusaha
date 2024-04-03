import 'package:bantu_pengusaha/core/routes/routes.dart';
import 'package:flutter/foundation.dart';
import 'package:get/get.dart';

class SplashController extends GetxController {
  //TODO: Implement SplashController

  final count = 0.obs;
  @override
  void onInit() {
    debugPrint("init");
    super.onInit();
  }

  @override
  void onReady() {
    debugPrint("r");
    super.onReady();
    Future.delayed(const Duration(seconds: 3), () {
      Get.offAllNamed(Routes.LOGIN);
    });
  }

  void increment() => count.value++;
}

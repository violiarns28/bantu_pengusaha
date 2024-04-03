import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../../../routes/app_pages.dart';
import '../controllers/splash_controller.dart';

class SplashView extends GetView<SplashController> {
  const SplashView({super.key});

  @override
  Widget build(BuildContext context) {
    Future.delayed(const Duration(seconds: 3), () {
      Get.toNamed(Routes.LOGIN);
    });
    // Utilize GetX's delay feature
    return Scaffold(
      body: Center(
        child: Container(
          decoration: const BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
              colors: [
                Color(0xFFFFFFFF),
                Color(0xFFDCE5FF),
                Color(0xFF7DBBE8),
              ],
            ),
          ),
          child: Center(
            child: Container(
              decoration: const BoxDecoration(
                image: DecorationImage(
                  // Corrected asset path
                  image: AssetImage('assets/images/logoBantuPengusaha.png'),
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }
}

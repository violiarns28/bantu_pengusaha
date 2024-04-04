import 'package:bantu_pengusaha/core/services/location.dart';
import 'package:bantu_pengusaha/data/repo/auth/auth_repo_impl.dart';
import 'package:get/get.dart';

import '../controllers/splash_controller.dart';

class SplashBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<SplashController>(
      () => SplashController(
        Get.find<AuthRepoImpl>(),
        Get.find<LocationService>(),
      ),
    );
  }
}

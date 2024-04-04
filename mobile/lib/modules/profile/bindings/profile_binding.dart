import 'package:bantu_pengusaha/core/services/local.dart';
import 'package:bantu_pengusaha/data/repo/auth/auth_repo_impl.dart';
import 'package:get/get.dart';

import '../controllers/profile_controller.dart';

class ProfileBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<ProfileController>(
      () => ProfileController(
        Get.find<AuthRepoImpl>(),
        Get.find<LocalService>(),
      ),
    );
  }
}

import 'package:bantu_pengusaha/core/routes/routes.dart';
import 'package:bantu_pengusaha/core/services/location.dart';
import 'package:bantu_pengusaha/data/repo/auth/auth.dart';
import 'package:get/get.dart';

class SplashController extends GetxController {
  final AuthRepo _authRepo;
  final LocationService _locationService;

  SplashController(
    this._authRepo,
    this._locationService,
  );

  @override
  void onReady() async {
    super.onReady();
    bool isOk = await _locationService.requestPermission();
    final me = await _authRepo.me();
    if (isOk) {
      Future.delayed(const Duration(seconds: 3), () {
        if (me.success) {
          Get.offAllNamed(Routes.BOTTOM_NAV_BAR);
        } else {
          Get.offAllNamed(Routes.LOGIN);
        }
      });
    } else {
      Get.snackbar('Location permission required',
          "To use this app please allow location permission");
      isOk = await _locationService.requestPermission();
      Future.delayed(const Duration(seconds: 3), () {
        if (me.success) {
          Get.offAllNamed(Routes.BOTTOM_NAV_BAR);
        } else {
          Get.offAllNamed(Routes.LOGIN);
        }
      });
    }
  }
}

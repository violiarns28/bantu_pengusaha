import 'package:bantu_pengusaha/core/routes/app_pages.dart';
import 'package:bantu_pengusaha/core/services/services.dart';
import 'package:bantu_pengusaha/data/repo/repo.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class LoginController extends GetxController {
  late TextEditingController email;
  late TextEditingController password;
  final AuthRepo _authRepo;
  final LocationService _locationService;

  var isPasswordVisible = false.obs;

  LoginController(this._authRepo, this._locationService);

  @override
  void onInit() {
    super.onInit();
    email = TextEditingController();
    password = TextEditingController();
    initRepo();
    _checkLoggedInUser();
  }

  void initRepo() async {
    final me = await _authRepo.me();
    if (me.success) {
      Get.toNamed(Routes.BOTTOM_NAV_BAR);
    }
  }

  Future<void> _checkLoggedInUser() async {
    final me = await _authRepo.me();
    if (me.success) {
      Get.toNamed(Routes.BOTTOM_NAV_BAR);
    }
  }

  @override
  void onClose() {
    email.dispose();
    password.dispose();
    super.onClose();
  }

  void login(String email, String password) async {
    final perm = await _locationService.requestPermission();

    if (perm) {
      final res = await _authRepo.login(email, password);
      if (res.success) {
        Get.offAllNamed(Routes.BOTTOM_NAV_BAR);
      } else {
        Get.snackbar('Error', res.message ?? 'Unknown error');
      }
    } else {
      Get.snackbar('Location permission required',
          "To use this app please allow location permission");
    }
  }

  void togglePasswordVisibility() {
    isPasswordVisible.value = !isPasswordVisible.value;
  }
}

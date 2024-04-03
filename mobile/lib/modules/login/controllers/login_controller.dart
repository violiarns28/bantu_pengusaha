import 'package:bantu_pengusaha/core/routes/app_pages.dart';
import 'package:bantu_pengusaha/data/repo/auth/auth.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class LoginController extends GetxController {
  late TextEditingController email;
  late TextEditingController password;
  final AuthRepo _authRepo;

  LoginController(this._authRepo);

  @override
  void onInit() async {
    email = TextEditingController();
    password = TextEditingController();
    final me = await _authRepo.me();
    if (me.success) {
      Get.toNamed(Routes.BOTTOM_NAV_BAR);
    }

    email.text = 'a@a.com';
    password.text = 'password';
    super.onInit();
  }

  @override
  void onClose() {
    email.dispose();
    password.dispose();
    super.onClose();
  }

  void login(String email, String password) async {
    final res = await _authRepo.login(email, password);
    if (res.success) {
      Get.toNamed(Routes.BOTTOM_NAV_BAR);
    } else {
      Get.snackbar('Error', res.message);
    }
  }
}

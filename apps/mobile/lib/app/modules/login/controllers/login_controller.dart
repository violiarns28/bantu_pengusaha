import 'dart:convert';

import 'package:bantu_pengusaha/app/modules/bottomNavBar/views/bottom_nav_bar_view.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../../../network/api.dart';

class LoginController extends GetxController {
  late TextEditingController email;
  late TextEditingController password;

  @override
  void onInit() {
    email = TextEditingController();
    password = TextEditingController();
    super.onInit();
  }

  @override
  void onClose() {
    email.dispose();
    password.dispose();
    super.onClose();
  }

  void login(String email, String password) async {
    var data = {'email': email, 'password': password};
    var res = await Network().postData('/login', data);
    var body = json.decode(res.body);
    debugPrint(res.body);

    if (body != null && body['success'] != null && body['success']) {
      SharedPreferences localStorage = await SharedPreferences.getInstance();
      localStorage.setString('token', body['data']['token']);
      localStorage.setString('user', json.encode(body['data']['user']));
      Get.to(() => const BottomNavBarView());
    }
  }
}

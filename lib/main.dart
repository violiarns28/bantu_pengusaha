import 'package:flutter/material.dart';
import 'package:get/get.dart';
import 'package:oktoast/oktoast.dart';

import 'app/routes/app_pages.dart';

void main() {
  runApp(
    OKToast(
      child: GetMaterialApp(
        debugShowCheckedModeBanner: false,
        title: "Application",
        initialRoute: AppPages.INITIAL,
        getPages: AppPages.routes,
      ),
    ),
  );
}

import 'package:get/get.dart';

class BottomNavBarController extends GetxController {
  //TODO: Implement BottomNavBarController

  var selectedIndex = 0.obs;

  void changePage(int index) {
    selectedIndex.value = index;
  }

  @override
  void onInit() {
    super.onInit();
  }

  @override
  void onReady() {
    super.onReady();
  }

  @override
  void onClose() {
    super.onClose();
  }

  // void increment() => count.value++;
}

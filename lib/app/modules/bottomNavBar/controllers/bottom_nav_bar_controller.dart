import 'package:get/get.dart';

class BottomNavBarController extends GetxController {
  //TODO: Implement BottomNavBarController

  final selectedIndex = 0.obs;
  final lastClockIn = DateTime.now().obs;

  void changePage(int index) {
    selectedIndex.value = index;
  }

  @override
  void onInit() {
    // fetch last clockin from API
    // mutate last clockin variable
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

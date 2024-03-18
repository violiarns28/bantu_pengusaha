import 'package:get/get.dart';

class HomeController extends GetxController {
  //TODO: Implement HomeController

  var tabIndex = 0;

  void changeTabIndex(int index) {
    tabIndex = index;

    update();
  }

  final count = 0.obs;

  // var userData;

  @override
  void onInit() {
    // _getUserInfo();

    super.onInit();
  }

  // void _getUserInfo() async {

  //   SharedPreferences localStorage = await SharedPreferences.getInstance();

  //   var userJson = localStorage.getString('User');

  //   var user = json.decode(userJson!);

  //   setState(() {

  //     userData = user;

  //   });

  // }

  @override
  void onReady() {
// Future.delayed(const Duration(seconds: 3), () {

// Get.offAllNamed(Routes.CLOCK_IN);

// });

    super.onReady();
  }

  @override
  void onClose() {
    super.onClose();
  }

  void increment() => count.value++;
}

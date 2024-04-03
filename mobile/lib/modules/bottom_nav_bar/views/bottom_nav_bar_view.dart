import 'package:bantu_pengusaha/modules/modules.dart';
import 'package:curved_labeled_navigation_bar/curved_navigation_bar.dart';
import 'package:curved_labeled_navigation_bar/curved_navigation_bar_item.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class BottomNavBarView extends GetView<BottomNavBarController> {
  const BottomNavBarView({super.key});

  @override
  Widget build(BuildContext context) {
    return Obx(
      () {
        return Scaffold(
          body: IndexedStack(
            index: controller.selectedIndex.value,
            children: const [
              HomeView(),
              AttendanceView(),
              ProfileView(),
            ],
          ),
          bottomNavigationBar: CurvedNavigationBar(
            items: [
              CurvedNavigationBarItem(
                child: Icon(
                  Icons.home_filled,
                  color: controller.selectedIndex.value == 0
                      ? Colors.white
                      : Colors.black,
                ),
                label: 'Home',
              ),
              CurvedNavigationBarItem(
                child: Icon(
                  Icons.rule_rounded,
                  color: controller.selectedIndex.value == 1
                      ? Colors.white
                      : Colors.black,
                ),
                label: 'Attendance',
              ),
              CurvedNavigationBarItem(
                child: Icon(
                  Icons.person_2_rounded,
                  color: controller.selectedIndex.value == 2
                      ? Colors.white
                      : Colors.black,
                ),
                label: 'Profile',
              ),
            ],
            backgroundColor: Colors.transparent,
            index: controller.selectedIndex.value,
            onTap: controller.changePage,
            color: const Color(0xFFCFDFFC).withOpacity(0.7),
            buttonBackgroundColor: const Color(0xFF7C96CB),
            height: 65,
            animationDuration: const Duration(milliseconds: 200),
            animationCurve: Curves.easeInOut,
          ),
        );
      },
    );
  }
}

import 'package:curved_labeled_navigation_bar/curved_navigation_bar.dart';
import 'package:curved_labeled_navigation_bar/curved_navigation_bar_item.dart';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

import '../controllers/bottom_nav_bar_controller.dart';

class BottomNavBarView extends StatelessWidget {
  final BottomNavBarController _controller = Get.put(BottomNavBarController());

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: const Color(0xFFFFFFFF),
      bottomNavigationBar: CurvedNavigationBar(
        index: _controller.selectedIndex.value,
        height: 65.0,
        backgroundColor: const Color(0xFFFFFFFF),
        color: const Color(0xFFCFDFFC).withOpacity(0.7),
        animationDuration: Duration(milliseconds: 600),
        onTap: _controller.changePage,
        items: [
          CurvedNavigationBarItem(
            child: Icon(
              Icons.home_outlined,
              size: 30,
            ),
            label: 'Home',
          ),
          CurvedNavigationBarItem(
            child: Icon(
              Icons.rule_rounded,
              size: 30,
            ),
            label: 'Attendance',
          ),
          CurvedNavigationBarItem(
            child: Icon(
              Icons.person_2_outlined,
              size: 30,
            ),
            label: 'Profile',
          ),
        ],
      ),
    );
  }
}

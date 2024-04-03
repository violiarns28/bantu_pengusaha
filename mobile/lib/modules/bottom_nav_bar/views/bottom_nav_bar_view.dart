import 'package:bantu_pengusaha/modules/attendance/views/attendance_view.dart';
import 'package:bantu_pengusaha/modules/home/views/home_view.dart';
import 'package:curved_labeled_navigation_bar/curved_navigation_bar.dart';
import 'package:curved_labeled_navigation_bar/curved_navigation_bar_item.dart';
import 'package:flutter/material.dart';

import '../../profile/views/profile_view.dart';

class BottomNavBarView extends StatefulWidget {
  const BottomNavBarView({super.key});

  @override
  State<BottomNavBarView> createState() => BottomNavBarViewState();
}

class BottomNavBarViewState extends State<BottomNavBarView> {
  int tabIndex = 0;

  void changeTabIndex(int index) {
    setState(() {
      tabIndex = index;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: IndexedStack(
        index: tabIndex,
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
              color: tabIndex == 0 ? Colors.white : Colors.black,
            ),
            label: 'Home',
          ),
          CurvedNavigationBarItem(
            child: Icon(
              Icons.rule_rounded,
              color: tabIndex == 1 ? Colors.white : Colors.black,
            ),
            label: 'Attendance',
          ),
          CurvedNavigationBarItem(
            child: Icon(
              Icons.person_2_rounded,
              color: tabIndex == 2 ? Colors.white : Colors.black,
            ),
            label: 'Profile',
          ),
        ],
        backgroundColor: Colors.transparent,
        index: tabIndex,
        onTap: changeTabIndex,
        color: const Color(0xFFCFDFFC).withOpacity(0.7),
        buttonBackgroundColor: const Color(0xFF7C96CB),
        height: 65,
        animationDuration: const Duration(milliseconds: 200),
        animationCurve: Curves.easeInOut,
      ),
    );
  }
}

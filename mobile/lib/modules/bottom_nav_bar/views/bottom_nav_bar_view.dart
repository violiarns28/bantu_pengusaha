import 'package:bantu_pengusaha/modules/modules.dart'; // Mengimpor modul yang diperlukan
import 'package:curved_labeled_navigation_bar/curved_navigation_bar.dart'; // Mengimpor curved_navigation_bar
import 'package:curved_labeled_navigation_bar/curved_navigation_bar_item.dart'; // Mengimpor curved_navigation_bar_item
import 'package:flutter/material.dart'; // Mengimpor material.dart dari Flutter
import 'package:get/get.dart'; // Mengimpor GetX

class BottomNavBarView extends GetView<BottomNavBarController> {
  const BottomNavBarView({super.key}); // Konstruktor BottomNavBarView

  @override
  Widget build(BuildContext context) {
    return Obx(
      // Menggunakan Obx untuk memantau perubahan pada selectedIndex
      () {
        return Scaffold(
          // Scaffold sebagai struktur dasar halaman
          body: IndexedStack(
            // IndexedStack untuk menampilkan halaman berdasarkan selectedIndex
            index:
                controller.selectedIndex.value, // Indeks halaman yang dipilih
            children: const [
              HomeView(), // Halaman Home
              AttendanceView(), // Halaman Attendance
              ProfileView(), // Halaman Profile
            ],
          ),
          bottomNavigationBar: CurvedNavigationBar(
            // CurvedNavigationBar sebagai bottom navigation bar
            items: [
              CurvedNavigationBarItem(
                child: Icon(
                  Icons.home_filled,
                  color: controller.selectedIndex.value ==
                          0 // Warna ikon berdasarkan selectedIndex
                      ? Colors.white
                      : Colors.black,
                ),
                label: 'Home', // Label untuk item
              ),
              CurvedNavigationBarItem(
                child: Icon(
                  Icons.rule_rounded,
                  color: controller.selectedIndex.value ==
                          1 // Warna ikon berdasarkan selectedIndex
                      ? Colors.white
                      : Colors.black,
                ),
                label: 'Attendance', // Label untuk item
              ),
              CurvedNavigationBarItem(
                child: Icon(
                  Icons.person_2_rounded,
                  color: controller.selectedIndex.value ==
                          2 // Warna ikon berdasarkan selectedIndex
                      ? Colors.white
                      : Colors.black,
                ),
                label: 'Profile', // Label untuk item
              ),
            ],
            backgroundColor:
                Colors.transparent, // Warna latar belakang transparan
            index: controller.selectedIndex.value, // Indeks yang dipilih
            onTap: controller
                .changePage, // Fungsi yang dipanggil saat item ditekan
            color: const Color(0xFFCFDFFC)
                .withOpacity(0.7), // Warna latar belakang
            buttonBackgroundColor:
                const Color(0xFF7C96CB), // Warna latar belakang tombol
            height: 65, // Tinggi bottom navigation bar
            animationDuration:
                const Duration(milliseconds: 200), // Durasi animasi
            animationCurve: Curves.easeInOut, // Kurva animasi
          ),
        );
      },
    );
  }
}

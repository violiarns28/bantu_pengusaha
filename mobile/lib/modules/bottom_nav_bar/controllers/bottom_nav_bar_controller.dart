import 'package:bantu_pengusaha/data/repo/repo.dart'; // Mengimpor repositori yang diperlukan
import 'package:get/get.dart'; // Mengimpor Get untuk manajemen status

class BottomNavBarController extends GetxController {
  final selectedIndex =
      0.obs; // Observable untuk menyimpan indeks halaman terpilih

  void changePage(int index) {
    selectedIndex.value = index; // Mengubah nilai indeks terpilih
    update(); // Memperbarui UI jika diperlukan
  }

  @override
  void onInit() {
    initRepo(); // Menginisialisasi repositori yang diperlukan
    super.onInit(); // Memanggil onInit dari superclass
  }
}

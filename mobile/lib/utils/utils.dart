export 'logger.dart';

extension StringExtension on String {
  String clearLocalityPrefix() {
    if (contains('Kecamatan')) {
      // Jika string mengandung 'Kecamatan'
      return replaceAll('Kecamatan', '')
          .trim(); // Menghapus 'Kecamatan' dari string dan menghapus spasi di awal dan akhir
    } else if (contains('Kabupaten')) {
      // Jika string mengandung 'Kabupaten'
      return replaceAll('Kabupaten', '')
          .trim(); // Menghapus 'Kabupaten' dari string dan menghapus spasi di awal dan akhir
    } else if (contains('Kota')) {
      // Jika string mengandung 'Kota'
      return replaceAll('Kota', '')
          .trim(); // Menghapus 'Kota' dari string dan menghapus spasi di awal dan akhir
    } else {
      return this; // Mengembalikan string asli jika tidak ada prefix yang sesuai
    }
  }
}

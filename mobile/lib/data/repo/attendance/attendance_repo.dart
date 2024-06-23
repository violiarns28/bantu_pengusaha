import 'package:bantu_pengusaha/data/models/models.dart'; // Mengimpor semua model yang diperlukan, termasuk AttendanceModel

/// Kontrak (interface) untuk repository kehadiran (AttendanceRepo)
abstract class AttendanceRepo {
  /// Metode untuk mendapatkan semua data kehadiran
  Future<ApiResponse<List<AttendanceModel>>> getAll();

  /// Metode untuk menyimpan data kehadiran baru
  Future<ApiResponse<AttendanceModel>> save(
    double latitude,
    double longitude,
  );
}

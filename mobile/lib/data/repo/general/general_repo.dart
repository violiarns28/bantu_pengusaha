import 'package:bantu_pengusaha/data/models/models.dart'; // Mengimpor model-model yang diperlukan

abstract class GeneralRepo {
  /// Metode untuk mendapatkan lokasi umum atau lokasi tertentu.
  /// Mengembalikan ApiResponse<List<GeneralModel>> berisi daftar GeneralModel dari respons server.
  Future<ApiResponse<List<GeneralModel>>> getLocation();
}

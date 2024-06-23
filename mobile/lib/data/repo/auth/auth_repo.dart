import 'package:bantu_pengusaha/data/models/models.dart'; // Mengimpor model UserModel

abstract class AuthRepo {
  /// Metode untuk melakukan login pengguna.
  /// Mengembalikan ApiResponse<UserModel> berisi UserModel dari respons server.
  Future<ApiResponse<UserModel>> login(
    String email,
    String password,
  );

  /// Metode untuk mendaftarkan pengguna baru.
  /// Mengembalikan ApiResponse<UserModel> berisi UserModel dari respons server.
  Future<ApiResponse<UserModel>> register(
    String name,
    String email,
    String password,
  );

  /// Metode untuk mendapatkan data pengguna saat ini.
  /// Mengembalikan ApiResponse<UserModel> berisi UserModel dari respons server.
  Future<ApiResponse<UserModel>> me();

  /// Metode untuk melakukan logout pengguna.
  /// Mengembalikan ApiResponse yang menunjukkan status logout.
  Future<ApiResponse> logout();
}

import 'package:bantu_pengusaha/data/models/models.dart';

abstract class AuthRepo {
  Future<ApiResponse<UserModel>> login(
    String email,
    String password,
  );

  Future<ApiResponse<UserModel>> register(
    String name,
    String email,
    String password,
  );

  Future<ApiResponse<UserModel>> me();

  Future<ApiResponse> logout();
}

import 'package:bantu_pengusaha/core/constant/list_api.dart'; // Mengimpor daftar endpoint API
import 'package:bantu_pengusaha/core/services/local.dart'; // Mengimpor layanan lokal untuk manajemen penyimpanan
import 'package:bantu_pengusaha/data/models/api_response.dart'; // Mengimpor model ApiResponse
import 'package:bantu_pengusaha/data/models/user.dart'; // Mengimpor model UserModel
import 'package:bantu_pengusaha/data/repo/auth/auth.dart'; // Mengimpor kontrak repository auth
import 'package:bantu_pengusaha/utils/logger.dart'; // Mengimpor utilitas logging
import 'package:get/get_connect/connect.dart'; // Mengimpor GetConnect dari package get_connect

class AuthRepoImpl extends GetConnect implements AuthRepo {
  final LocalService
      _local; // Instance layanan lokal untuk manajemen penyimpanan

  AuthRepoImpl(this._local); // Constructor untuk menginisialisasi _local

  /// Decoder untuk mengubah data dari respons HTTP menjadi objek yang sesuai
  static dynamic decoder(data) {
    log.e('Data: $data');

    if (data == null || data['data'] == null || data['success'] == false) {
      return data;
    }
    data['data'] = UserModel.fromJson(data['data']);
    return data;
  }

  @override
  Future<ApiResponse<UserModel>> login(
    String email,
    String password,
  ) async {
    final res = await post(
      ListApi.authLogin,
      {'email': email, 'password': password},
      headers: _local.setHeaders(),
      decoder: decoder,
    );

    // Jika berhasil login, simpan user dan token ke penyimpanan lokal
    if (res.body != null && res.body['data'] != null) {
      await _local.setUser(res.body['data']);
      await _local.setToken(res.body['data'].token);
    }

    return ApiResponse<UserModel>.fromJson(res.body);
  }

  @override
  Future<ApiResponse<UserModel>> register(
    String name,
    String email,
    String password,
  ) async {
    final res = await post(
      ListApi.authRegister,
      {'name': name, 'email': email, 'password': password},
      headers: _local.setHeaders(),
      decoder: decoder,
    );

    return ApiResponse<UserModel>.fromJson(res.body);
  }

  @override
  Future<ApiResponse<UserModel>> me() async {
    final res = await get(
      ListApi.authMe,
      headers: _local.setHeaders(),
      decoder: decoder,
    );

    log.f('AuthRepo.me ${res.body}\n${ListApi.authMe}');

    return ApiResponse<UserModel>.fromJson(res.body);
  }

  @override
  Future<ApiResponse> logout() async {
    final res = await get(
      ListApi.authLogout,
      headers: _local.setHeaders(),
      decoder: decoder,
    );

    // Setelah logout, hapus token dan data user dari penyimpanan lokal
    await _local.removeToken();
    await _local.removeUser();

    return ApiResponse.fromJson(res.body);
  }
}

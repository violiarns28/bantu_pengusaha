import 'package:bantu_pengusaha/core/constant/list_api.dart';
import 'package:bantu_pengusaha/core/services/local.dart';
import 'package:bantu_pengusaha/data/models/api_response.dart';
import 'package:bantu_pengusaha/data/models/user.dart';
import 'package:bantu_pengusaha/data/repo/auth/auth.dart';
import 'package:get/get_connect/connect.dart';

class AuthRepoImpl extends GetConnect implements AuthRepo {
  final LocalService _local;

  AuthRepoImpl(this._local);

  static decoder(data) {
    if (data['data'] == null) {
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
      headers: _local.setHeaders(),
      {'email': email, 'password': password},
      decoder: decoder,
    );

    await _local.setUser(res.body['data']);
    await _local.setToken(res.body['data'].token);

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
      headers: _local.setHeaders(),
      {'name': name, 'email': email, 'password': password},
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

    return ApiResponse<UserModel>.fromJson(res.body);
  }

  @override
  Future<ApiResponse> logout() async {
    final res = await get(
      ListApi.authLogout,
      headers: _local.setHeaders(),
      decoder: decoder,
    );
    await _local.removeToken();
    return ApiResponse.fromJson(res.body);
  }
}

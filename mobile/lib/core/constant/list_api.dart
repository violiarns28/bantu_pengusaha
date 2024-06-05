class ListApi {
  const ListApi._();

  // Base URL
  static const String baseUrl = 'http://192.168.214.169:3000/api';

  // Auth
  static const String authLogin = '$baseUrl/auth/login';
  static const String authRegister = '$baseUrl/auth/register';
  static const String authMe = '$baseUrl/auth/me';
  static const String authLogout = '$baseUrl/auth/logout';

  // Attendance
  static const String attendance = '$baseUrl/attendance';
}

import 'package:bantu_pengusaha/core/constant/constant.dart'; // Mengimpor konstanta yang diperlukan
import 'package:bantu_pengusaha/core/services/services.dart'; // Mengimpor layanan-layanan yang diperlukan
import 'package:bantu_pengusaha/data/models/api_response.dart'; // Mengimpor model ApiResponse
import 'package:bantu_pengusaha/data/models/attendance.dart'; // Mengimpor model AttendanceModel
import 'package:bantu_pengusaha/data/repo/attendance/attendance.dart'; // Mengimpor kontrak AttendanceRepo
import 'package:bantu_pengusaha/utils/utils.dart'; // Mengimpor utilitas util
import 'package:get/get_connect/connect.dart'; // Mengimpor GetConnect dari paket get_connect

class AttendanceRepoImpl extends GetConnect implements AttendanceRepo {
  final LocalService
      _local; // Instance dari LocalService untuk manajemen penyimpanan lokal

  AttendanceRepoImpl(this._local); // Constructor untuk menginisialisasi _local

  /// Decoder untuk mengubah data dari respons HTTP menjadi objek yang sesuai
  static decoder(data) {
    log.e('AttendanceRepoImpl.decode $data');

    if (data['data'] == null) {
      return data;
    }
    if (data['data'] is List) {
      data['data'] = data['data']
          .map((e) => AttendanceModel.fromJson(e))
          .toList()
          .cast<AttendanceModel>();
    } else {
      data['data'] = AttendanceModel.fromJson(data['data']);
    }
    return data;
  }

  @override
  Future<ApiResponse<List<AttendanceModel>>> getAll() async {
    final res = await get(
      ListApi
          .attendance, // Mengirimkan permintaan GET ke endpoint ListApi.attendance
      headers: _local
          .setHeaders(), // Menggunakan headers dari LocalService untuk autentikasi
      decoder:
          decoder, // Menggunakan decoder untuk mengubah respons HTTP menjadi List<AttendanceModel>
    );

    return ApiResponse<List<AttendanceModel>>.fromJson(
        res.body); // Mengembalikan ApiResponse<List<AttendanceModel>>
  }

  @override
  Future<ApiResponse<AttendanceModel>> save(
    double latitude,
    double longitude,
  ) async {
    final mac = await _local.getDeviceId() ??
        'unknown'; // Mendapatkan ID perangkat dari LocalService

    final res = await post(
      ListApi
          .attendance, // Mengirimkan permintaan POST ke endpoint ListApi.attendance
      headers: _local
          .setHeaders(), // Menggunakan headers dari LocalService untuk autentikasi
      {
        'latitude': latitude,
        'longitude': longitude,
        'mac_address': mac,
      }, // Data yang dikirimkan berisi latitude, longitude, dan mac_address
      decoder:
          decoder, // Menggunakan decoder untuk mengubah respons HTTP menjadi AttendanceModel
    );

    return ApiResponse<AttendanceModel>.fromJson(
        res.body); // Mengembalikan ApiResponse<AttendanceModel>
  }
}

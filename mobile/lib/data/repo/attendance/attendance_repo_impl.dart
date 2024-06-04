import 'package:bantu_pengusaha/core/constant/constant.dart';
import 'package:bantu_pengusaha/core/services/services.dart';
import 'package:bantu_pengusaha/data/models/api_response.dart';
import 'package:bantu_pengusaha/data/models/attendance.dart';
import 'package:bantu_pengusaha/data/repo/attendance/attendance.dart';
import 'package:bantu_pengusaha/utils/utils.dart';
import 'package:get/get_connect/connect.dart';

class AttendanceRepoImpl extends GetConnect implements AttendanceRepo {
  final LocalService _local;

  AttendanceRepoImpl(this._local);

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
      ListApi.attendance,
      headers: _local.setHeaders(),
      decoder: decoder,
    );

    return ApiResponse<List<AttendanceModel>>.fromJson(res.body);
  }

  @override
  Future<ApiResponse<AttendanceModel>> save(
    double latitude,
    double longitude,
  ) async {
    final mac = await _local.getDeviceId() ?? 'unknown';

    final res = await post(
      ListApi.attendance,
      headers: _local.setHeaders(),
      {
        'latitude': latitude,
        'longitude': longitude,
        'mac_address': mac,
      },
      decoder: decoder,
    );

    return ApiResponse<AttendanceModel>.fromJson(res.body);
  }
}

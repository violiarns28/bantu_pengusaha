import 'package:bantu_pengusaha/data/models/models.dart';

abstract class AttendanceRepo {
  Future<ApiResponse<List<AttendanceModel>>> getAll();
  Future<ApiResponse<AttendanceModel>> save(
    double latitude,
    double longitude,
  );
}


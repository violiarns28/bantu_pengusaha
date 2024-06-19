import 'package:bantu_pengusaha/core/constant/constant.dart';
import 'package:bantu_pengusaha/core/services/local.dart';
import 'package:bantu_pengusaha/data/models/models.dart';
import 'package:bantu_pengusaha/data/repo/repo.dart';
import 'package:bantu_pengusaha/utils/logger.dart';
import 'package:get/get_connect/connect.dart';

class GeneralRepoImpl extends GetConnect implements GeneralRepo {
  final LocalService _local;

  GeneralRepoImpl(this._local);

  static decoder(data) {
    log.e('GeneralRepo.decode $data');

    if (data['data'] == null) {
      return data;
    }
    if (data['data'] is List) {
      data['data'] = data['data']
          .map((e) => GeneralModel.fromJson(e))
          .toList()
          .cast<GeneralModel>();
    } else {
      data['data'] = [GeneralModel.fromJson(data['data'])];
    }
    return data;
  }

  @override
  Future<ApiResponse<List<GeneralModel>>> getLocation() async {
    final res = await get(
      ListApi.generalLocation,
      headers: _local.setHeaders(),
      decoder: decoder,
    );

    return ApiResponse<List<GeneralModel>>.fromJson(res.body);
  }
}

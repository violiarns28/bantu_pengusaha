import 'package:bantu_pengusaha/core/constant/constant.dart'; // Mengimpor konstanta yang diperlukan
import 'package:bantu_pengusaha/core/services/local.dart'; // Mengimpor layanan LocalService
import 'package:bantu_pengusaha/data/models/models.dart'; // Mengimpor model-model yang diperlukan
import 'package:bantu_pengusaha/data/repo/repo.dart'; // Mengimpor kontrak GeneralRepo
import 'package:bantu_pengusaha/utils/logger.dart'; // Mengimpor logger untuk pencatatan
import 'package:get/get_connect/connect.dart'; // Mengimpor GetConnect dari paket get_connect

class GeneralRepoImpl extends GetConnect implements GeneralRepo {
  final LocalService
      _local; // Instance dari LocalService untuk manajemen penyimpanan lokal

  GeneralRepoImpl(this._local); // Constructor untuk menginisialisasi _local

  /// Decoder untuk mengubah data dari respons HTTP menjadi objek yang sesuai
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
      ListApi
          .generalLocation, // Mengirimkan permintaan GET ke endpoint ListApi.generalLocation
      headers: _local
          .setHeaders(), // Menggunakan headers dari LocalService untuk autentikasi
      decoder:
          decoder, // Menggunakan decoder untuk mengubah respons HTTP menjadi List<GeneralModel>
    );

    return ApiResponse<List<GeneralModel>>.fromJson(
        res.body); // Mengembalikan ApiResponse<List<GeneralModel>>
  }
}

import 'package:bantu_pengusaha/data/models/models.dart';

abstract class GeneralRepo {
  Future<ApiResponse<List<GeneralModel>>> getLocation();
}

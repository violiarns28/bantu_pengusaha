class GeneralModel {
  int id; // ID dari model umum
  String key; // Kunci dari model umum
  Map<String, dynamic> value; // Nilai dinamis dari model umum
  DateTime createdAt; // Tanggal dan waktu pembuatan entri
  DateTime updatedAt; // Tanggal dan waktu pembaruan terakhir

  GeneralModel({
    required this.id,
    required this.key,
    required this.value,
    required this.createdAt,
    required this.updatedAt,
  });

  /// Factory method untuk membuat instance GeneralModel dari JSON
  factory GeneralModel.fromJson(Map<String, dynamic> json) => GeneralModel(
        id: json["id"],
        key: json["key"],
        value: json["value"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
      );

  /// Mengkonversi objek GeneralModel menjadi map JSON
  Map<String, dynamic> toJson() => {
        "id": id,
        "key": key,
        "value": value,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
      };
}
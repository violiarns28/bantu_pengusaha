class AttendanceModel {
  int id; // ID kehadiran
  int userId; // ID pengguna terkait kehadiran
  double latitude; // Koordinat lintang lokasi kehadiran
  double longitude; // Koordinat bujur lokasi kehadiran
  DateTime date; // Tanggal kehadiran
  String? clockIn; // Waktu masuk (opsional)
  String? clockOut; // Waktu keluar (opsional)
  DateTime createdAt; // Tanggal dan waktu pembuatan entri kehadiran
  DateTime updatedAt; // Tanggal dan waktu pembaruan entri kehadiran

  AttendanceModel({
    required this.id,
    required this.userId,
    required this.latitude,
    required this.longitude,
    required this.date,
    required this.clockIn,
    required this.clockOut,
    required this.createdAt,
    required this.updatedAt,
  });

  /// Factory method untuk membuat instance AttendanceModel dari JSON
  factory AttendanceModel.fromJson(Map<String, dynamic> json) =>
      AttendanceModel(
        id: json["id"],
        userId: json["user_id"],
        latitude: json["latitude"],
        longitude: json["longitude"],
        date: DateTime.parse(json["date"]),
        clockIn: json["clock_in"],
        clockOut: json["clock_out"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
      );

  /// Mengkonversi objek AttendanceModel menjadi map JSON
  Map<String, dynamic> toJson() => {
        "id": id,
        "user_id": userId,
        "latitude": latitude,
        "longitude": longitude,
        "date": date.toIso8601String(),
        "clock_in": clockIn,
        "clock_out": clockOut,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
      };
}
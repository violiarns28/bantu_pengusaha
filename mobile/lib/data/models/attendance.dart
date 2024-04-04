class AttendanceModel {
  int id;
  int userId;
  double latitude;
  double longitude;
  DateTime date;
  String? clockIn;
  String? clockOut;
  DateTime createdAt;
  DateTime updatedAt;

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

  Map<String, dynamic> toJson() => {
        "id": id,
        "user_id": userId,
        "latitude": latitude,
        "longitude": longitude,
        "date": date,
        "clock_in": clockIn,
        "clock_out": clockOut,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
      };
}


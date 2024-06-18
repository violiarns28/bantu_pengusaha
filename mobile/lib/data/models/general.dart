class GeneralModel {
  int id;
  String key;
  Map<String, dynamic> value;
  DateTime createdAt;
  DateTime updatedAt;

  GeneralModel({
    required this.id,
    required this.key,
    required this.value,
    required this.createdAt,
    required this.updatedAt,
  });

  factory GeneralModel.fromJson(Map<String, dynamic> json) => GeneralModel(
        id: json["id"],
        key: json["key"],
        value: json["value"],
        createdAt: DateTime.parse(json["created_at"]),
        updatedAt: DateTime.parse(json["updated_at"]),
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "key": key,
        "value": value,
        "created_at": createdAt.toIso8601String(),
        "updated_at": updatedAt.toIso8601String(),
      };
}

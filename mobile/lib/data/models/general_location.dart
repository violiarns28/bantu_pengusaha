class GeneralLocationModel {
  double latitude;
  double longitude;

  GeneralLocationModel({
    required this.latitude,
    required this.longitude,
  });

  factory GeneralLocationModel.fromJson(Map<String, dynamic> json) =>
      GeneralLocationModel(
          latitude: json['latitude'], longitude: json['longitude']);

  Map<String, dynamic> toJson() =>
      {'latitude': latitude, 'longitude': longitude};
}

class ApiResponse<T> {
  final T? data; // Data dari respons API, bisa berupa objek atau daftar objek
  final bool success; // Status keberhasilan respons
  final String message; // Pesan terkait respons

  ApiResponse({
    this.data,
    required this.success,
    required this.message,
  });

  /// Factory method untuk membuat instance ApiResponse dari JSON
  factory ApiResponse.fromJson(Map<String, dynamic> json) {
    return ApiResponse(
      data: json['data'], // Mendapatkan data dari properti 'data' dalam JSON
      success: json[
          'success'], // Mendapatkan status keberhasilan dari properti 'success' dalam JSON
      message: json[
          'message'], // Mendapatkan pesan dari properti 'message' dalam JSON
    );
  }
}
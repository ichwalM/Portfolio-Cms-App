# 📱 Wall App API Documentation

Dokumentasi untuk endpoint Wall App API yang digunakan untuk mengambil data informasi aplikasi yang akan ditampilkan.

## 📋 Daftar Isi
- [Overview](#overview)
- [Wall App Endpoint](#wall-app-endpoint)

---

## 📌 Overview

| Endpoint | Method | Auth | Deskripsi |
|----------|--------|------|-----------|
| `/wall-apps` | GET | API Key | Get all wall apps information |

---

## 📱 Wall App Endpoint

### GET `/wall-apps`

Mengambil daftar semua Wall App yang terdaftar.

#### Request

```bash
curl -X GET "http://localhost:8000/api/v1/wall-apps?api_key=YOUR_API_KEY"
```

#### Response (200 OK)

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "My Awesome App",
      "url": "https://example.com",
      "icon": "http://localhost:8000/storage/wall-apps/5f9a1b2c3d4e5.webp",
      "description": "This is an amazing application for productivity.",
      "created_at": "2026-04-29T14:30:00.000000Z",
      "updated_at": "2026-04-29T14:30:00.000000Z"
    }
  ]
}
```

#### Response Fields

| Field | Type | Deskripsi |
|-------|------|-----------|
| `id` | integer | Wall App ID |
| `name` | string | Nama aplikasi |
| `url` | string | URL aplikasi |
| `icon` | string | URL icon aplikasi (WebP format) |
| `description` | string | Deskripsi aplikasi (opsional) |
| `created_at` | datetime | Waktu pembuatan |
| `updated_at` | datetime | Waktu pembaruan terakhir |

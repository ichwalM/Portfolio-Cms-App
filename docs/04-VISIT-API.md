# 📊 Visit API Documentation

Dokumentasi lengkap untuk endpoint Visit API yang menangani tracking kunjungan pengunjung website.

## 📋 Daftar Isi
- [Overview](#overview)
- [Endpoint Detail](#endpoint-detail)
- [Request Format](#request-format)
- [Response Format](#response-format)
- [Use Cases](#use-cases)
- [Examples](#examples)

---

## 📌 Overview

| Endpoint | Method | Auth | Deskripsi |
|----------|--------|------|-----------|
| `/visits` | POST | API Key | Mencatat kunjungan pengunjung |

---

## 📍 Endpoint Detail

### POST `/visits`

Endpoint untuk mencatat setiap kunjungan ke website. Secara otomatis mengambil informasi IP address dan User Agent dari request.

#### Request

```bash
curl -X POST "http://localhost:8000/api/v1/visits?api_key=YOUR_API_KEY" \
  -H "Content-Type: application/json"
```

#### Catatan Penting
- **Tidak memerlukan request body** - Sistem secara otomatis mengambil IP address dan User Agent dari server
- **Dipanggil setiap kali user mengakses halaman utama** - Biasanya dipanggil sekali saat halaman utama dimuat

---

## 📝 Request Format

### Headers

| Header | Value |
|--------|-------|
| `Content-Type` | `application/json` |
| `Accept` | `application/json` |

### Body (JSON)

Request body bisa kosong atau tidak dikirim sama sekali, karena server mengambil informasi dari:
- **IP Address** - Dari `request->ip()`
- **User Agent** - Dari `request->userAgent()`

```json
{
  // Empty or no body needed
}
```

---

## ✅ Response Format

### Success Response (201 Created)

Ketika kunjungan berhasil dicatat.

```json
{
  "message": "Visit recorded"
}
```

### Unauthorized (401 Unauthorized)

Ketika API key tidak valid atau tidak dikirim.

```json
{
  "success": false,
  "message": "Unauthorized. Invalid API key."
}
```

### Server Error (500 Internal Server Error)

Ketika ada error saat mencatat kunjungan.

```json
{
  "success": false,
  "message": "Failed to record visit. Please try again later."
}
```

---

## 🎯 Use Cases

### 1. Track Kunjungan Website
Catat setiap kali pengunjung masuk ke halaman utama portfolio untuk analytics.

### 2. Analisis Traffic
Kumpulkan data kunjungan untuk memahami pola traffic website.

### 3. Monitor Pengunjung
Lihat dari mana pengunjung berasal (berdasarkan IP dan User Agent).

### 4. Statistik Akses
Buat dashboard untuk melihat statistik kunjungan harian/mingguan/bulanan.

---

## 💡 Examples

### Example 1: Simple Request (cURL)

```bash
curl -X POST "http://localhost:8000/api/v1/visits?api_key=YOUR_API_KEY" \
  -H "Content-Type: application/json"
```

**Response:**
```json
{
  "message": "Visit recorded"
}
```

---

### Example 2: JavaScript/Fetch

```javascript
const recordVisit = async () => {
  const apiKey = import.meta.env.VITE_API_KEY;
  
  try {
    const response = await fetch(
      `http://localhost:8000/api/v1/visits?api_key=${apiKey}`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        }
      }
    );
    
    const data = await response.json();
    
    if (response.ok) {
      console.log('Visit recorded:', data.message);
    } else {
      console.error('Failed to record visit:', data);
    }
  } catch (error) {
    console.error('Error recording visit:', error);
  }
};

// Call on page load
recordVisit();
```

---

### Example 3: Axios

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api/v1',
  headers: {
    'X-API-Key': import.meta.env.VITE_API_KEY
  }
});

const recordVisit = async () => {
  try {
    const response = await api.post('/visits');
    console.log('Visit recorded:', response.data.message);
  } catch (error) {
    console.error('Error recording visit:', error);
  }
};

// Export for use in layout component
export { recordVisit };
```

---

### Example 4: Vue 3 - Record Visit on Page Load

```vue
<template>
  <div>
    <h1>Welcome to My Portfolio</h1>
    <!-- Page content -->
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api/v1',
  headers: {
    'X-API-Key': import.meta.env.VITE_API_KEY
  }
});

const recordVisit = async () => {
  try {
    await api.post('/visits');
    console.log('Your visit has been recorded!');
  } catch (error) {
    console.error('Failed to record visit:', error);
  }
};

onMounted(() => {
  // Record visit when component mounts (page loads)
  recordVisit();
});
</script>
```

---

### Example 5: React - Record Visit on Mount

```jsx
import { useEffect } from 'react';
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api/v1',
  headers: {
    'X-API-Key': process.env.REACT_APP_API_KEY
  }
});

const recordVisit = async () => {
  try {
    const response = await api.post('/visits');
    console.log('Visit recorded:', response.data.message);
  } catch (error) {
    console.error('Error recording visit:', error);
  }
};

export const Home = () => {
  useEffect(() => {
    // Record visit when component mounts
    recordVisit();
  }, []);

  return (
    <div>
      <h1>Welcome to My Portfolio</h1>
      {/* Page content */}
    </div>
  );
};
```

---

### Example 6: Next.js - Record Visit on Layout

```javascript
'use client';

import { useEffect } from 'react';

const recordVisit = async () => {
  try {
    const apiKey = process.env.NEXT_PUBLIC_API_KEY;
    const response = await fetch(
      `${process.env.NEXT_PUBLIC_API_URL}/visits?api_key=${apiKey}`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        }
      }
    );
    
    if (response.ok) {
      console.log('Visit recorded');
    }
  } catch (error) {
    console.error('Error recording visit:', error);
  }
};

export default function RootLayout({ children }) {
  useEffect(() => {
    recordVisit();
  }, []);

  return (
    <html>
      <body>
        {children}
      </body>
    </html>
  );
}
```

---

### Example 7: With Try-Catch and Loading State

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api/v1',
  headers: {
    'X-API-Key': import.meta.env.VITE_API_KEY
  }
});

const recordVisit = async () => {
  let isRecorded = false;
  let errorMessage = null;

  try {
    const response = await api.post('/visits', null, {
      timeout: 5000 // 5 second timeout
    });

    if (response.status === 201) {
      isRecorded = true;
      console.log('✓ Visit recorded successfully');
    }
  } catch (error) {
    if (error.code === 'ECONNABORTED') {
      errorMessage = 'Request timeout - took too long';
    } else if (error.response?.status === 401) {
      errorMessage = 'Unauthorized - Invalid API key';
    } else if (error.response?.status === 500) {
      errorMessage = 'Server error - Could not record visit';
    } else {
      errorMessage = error.message;
    }

    console.warn('✗ Failed to record visit:', errorMessage);
  }

  return { isRecorded, errorMessage };
};

export { recordVisit };
```

---

## 📊 Data yang Tersimpan

Setiap kunjungan akan disimpan ke tabel `visits` dengan struktur:

| Column | Type | Deskripsi | Contoh |
|--------|------|-----------|--------|
| `id` | increments | Visit ID | 1 |
| `ip_address` | string | IP address pengunjung | 192.168.1.1 |
| `user_agent` | string | Browser/Device info | Mozilla/5.0 (Windows NT 10.0; Win64; x64)... |
| `created_at` | timestamp | Waktu kunjungan | 2026-02-04 10:30:45 |

### Contoh Data User Agent

```
# Desktop - Chrome
Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36

# Desktop - Firefox
Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0

# Mobile - iPhone
Mozilla/5.0 (iPhone; CPU iPhone OS 17_2 like Mac OS X) AppleWebKit/605.1.15

# Mobile - Android
Mozilla/5.0 (Linux; Android 13; SM-A536B) AppleWebKit/537.36
```

---

## 🔍 Analisis Kunjungan

### Query untuk Analisis Dasar

```sql
-- Total kunjungan
SELECT COUNT(*) as total_visits FROM visits;

-- Kunjungan per hari
SELECT DATE(created_at) as date, COUNT(*) as visits 
FROM visits 
GROUP BY DATE(created_at) 
ORDER BY date DESC;

-- Unique IP addresses
SELECT COUNT(DISTINCT ip_address) as unique_visitors FROM visits;

-- Top 10 IP addresses
SELECT ip_address, COUNT(*) as count 
FROM visits 
GROUP BY ip_address 
ORDER BY count DESC 
LIMIT 10;

-- Browser distribution
SELECT user_agent, COUNT(*) as count 
FROM visits 
GROUP BY user_agent 
ORDER BY count DESC;
```

---

## 🎯 Best Practices

1. **Record Once Per Session** - Jangan record visit lebih dari sekali per session
2. **Handle Errors Gracefully** - Jangan buat website hang jika visit API error
3. **Use Timeout** - Set timeout untuk request agar tidak menunggu terlalu lama
4. **Batch Requests** - Kalau perlu, batch multiple visits dalam satu request
5. **Log Errors** - Log semua errors untuk debugging
6. **Privacy** - Informasikan user tentang tracking yang dilakukan
7. **GDPR Compliance** - Pertimbangkan privasi user saat menyimpan IP address

---

## ⚠️ Catatan Penting

- **IP Address** - Bisa jadi di-mask atau tidak akurat jika menggunakan VPN
- **User Agent** - Bisa di-customize oleh user, tidak 100% reliable
- **Privacy** - Pertimbangkan compliance dengan GDPR/CCPA
- **Storage** - Kunjungan akan terakumulasi, pertimbangkan untuk archive/delete data lama

---

## 🔗 Related

- [Setup & Autentikasi](./01-SETUP-AUTHENTICATION.md)
- [Portfolio API](./02-PORTFOLIO-API.md)
- [Contact API](./03-CONTACT-API.md)

# 📬 Backend API Documentation — Contact Form

**Untuk:** Backend Developer (Laravel)  
**Dari:** Frontend (Next.js)  
**Tanggal:** April 2026  

---

## Overview

Halaman `/contact` di portfolio frontend mengirimkan pesan dari pengunjung ke backend melalui HTTP request. Backend perlu menyediakan satu endpoint untuk menerima dan menyimpan pesan tersebut.

---

## Endpoint yang Dibutuhkan

### `POST /api/contact`

Menerima pesan dari form contact dan menyimpannya ke database.

---

## Request

### Headers

```http
Content-Type: application/json
Accept: application/json
```

### Query Parameter (jika pakai API key)

```
?api_key=YOUR_API_KEY
```

### Body (JSON)

```json
{
  "name": "Budi Santoso",
  "email": "budi@example.com",
  "subject": "Project collaboration",
  "message": "Halo, saya tertarik untuk berkolaborasi pada proyek web..."
}
```

### Field Details

| Field | Type | Required | Max | Keterangan |
|-------|------|----------|-----|-----------|
| `name` | string | ✅ Ya | 255 | Nama pengirim |
| `email` | string | ✅ Ya | 255 | Email pengirim, harus format email valid |
| `subject` | string | ❌ Tidak | 255 | Subjek pesan (opsional) |
| `message` | string | ✅ Ya | 5000 | Isi pesan utama |

---

## Response

### ✅ 200 OK — Berhasil

```json
{
  "success": true,
  "message": "Your message has been sent successfully."
}
```

### ❌ 422 Unprocessable Entity — Validasi Gagal

```json
{
  "success": false,
  "message": "The given data was invalid.",
  "errors": {
    "name": ["The name field is required."],
    "email": ["The email must be a valid email address."],
    "message": ["The message field is required."]
  }
}
```

### ❌ 500 Internal Server Error

```json
{
  "success": false,
  "message": "Failed to send message. Please try again later."
}
```

---

## Implementasi Laravel (Contoh)

### 1. Migration

```php
// database/migrations/xxxx_create_contact_messages_table.php

Schema::create('contact_messages', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email');
    $table->string('subject')->nullable();
    $table->text('message');
    $table->enum('status', ['unread', 'read', 'replied'])->default('unread');
    $table->timestamps();
});
```

### 2. Model

```php
// app/Models/ContactMessage.php

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status',
    ];
}
```

### 3. Request Validation

```php
// app/Http/Requests/ContactRequest.php

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ];
    }
}
```

### 4. Controller

```php
// app/Http/Controllers/Api/ContactController.php

class ContactController extends Controller
{
    public function store(ContactRequest $request): JsonResponse
    {
        try {
            $message = ContactMessage::create($request->validated());

            // Opsional: kirim notifikasi email ke pemilik portfolio
            // Mail::to('owner@example.com')->send(new ContactNotification($message));

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully.',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again later.',
            ], 500);
        }
    }
}
```

### 5. Route

```php
// routes/api.php

Route::post('/contact', [ContactController::class, 'store']);

// Jika pakai API key middleware:
Route::middleware('api.key')->post('/contact', [ContactController::class, 'store']);
```

### 6. CORS (jika frontend di domain berbeda)

Pastikan domain frontend masuk whitelist di `config/cors.php`:

```php
'allowed_origins' => [
    'https://walldev.my.id',
    'http://localhost:3000',
],
```

---

## Opsional: Notifikasi Email

Jika ingin dikirimkan notifikasi email ke pemilik setiap ada pesan masuk:

```php
// app/Mail/ContactNotification.php

class ContactNotification extends Mailable
{
    public function __construct(public ContactMessage $contact) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Portfolio] New message from ' . $this->contact->name,
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact');
    }
}
```

---

## Testing Endpoint (cURL)

```bash
curl -X POST https://cms.walldev.my.id/api/contact?api_key=YOUR_KEY \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Test User",
    "email": "test@example.com",
    "subject": "Test pesan",
    "message": "Ini adalah tes pengiriman pesan dari frontend."
  }'
```

### Response yang diharapkan:

```json
{
  "success": true,
  "message": "Your message has been sent successfully."
}
```

---

## Checklist Backend

- [ ] Buat migration `contact_messages`
- [ ] Jalankan `php artisan migrate`
- [ ] Buat Model `ContactMessage`
- [ ] Buat FormRequest `ContactRequest` dengan validasi
- [ ] Buat Controller `ContactController@store`
- [ ] Daftarkan route `POST /api/contact`
- [ ] Pastikan CORS mengizinkan domain frontend
- [ ] Test endpoint dengan cURL atau Postman
- [ ] (Opsional) Setup email notifikasi

---

## Catatan Tambahan

- Frontend sudah melakukan **client-side validation** (name, email format, message required), tapi backend tetap **wajib** melakukan server-side validation sebagai lapisan keamanan kedua.
- Frontend membaca field `message` dari response error untuk menampilkan pesan ke user — pastikan response error mengikuti format di atas.
- URL API dikonfigurasi via environment variable `NEXT_PUBLIC_API_URL` di frontend.

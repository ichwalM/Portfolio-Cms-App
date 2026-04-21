# 📬 Contact API Documentation

Dokumentasi lengkap untuk endpoint Contact API yang menangani pengiriman pesan kontak dari pengunjung.

## 📋 Daftar Isi
- [Overview](#overview)
- [Endpoint Detail](#endpoint-detail)
- [Request Format](#request-format)
- [Response Format](#response-format)
- [Validasi](#validasi)
- [Error Handling](#error-handling)
- [Examples](#examples)

---

## 📌 Overview

| Endpoint | Method | Auth | Deskripsi |
|----------|--------|------|-----------|
| `/contact` | POST | API Key | Mengirim pesan kontak |

---

## 📮 Endpoint Detail

### POST `/contact`

Endpoint untuk menerima dan menyimpan pesan kontak dari pengunjung website.

#### Request

```bash
curl -X POST "http://localhost:8000/api/v1/contact?api_key=YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Budi Santoso",
    "email": "budi@example.com",
    "subject": "Project Collaboration",
    "message": "Halo, saya tertarik untuk berkolaborasi pada proyek web..."
  }'
```

---

## 📝 Request Format

### Headers

| Header | Value |
|--------|-------|
| `Content-Type` | `application/json` |
| `Accept` | `application/json` |

### Body (JSON)

```json
{
  "name": "string (required)",
  "email": "string (required, valid email)",
  "subject": "string (optional)",
  "message": "string (required)"
}
```

### Request Fields

| Field | Type | Required | Max | Validasi | Deskripsi |
|-------|------|----------|-----|----------|-----------|
| `name` | string | ✅ Ya | 255 | Tidak boleh kosong | Nama pengirim pesan |
| `email` | string | ✅ Ya | 255 | Email valid | Email pengirim |
| `subject` | string | ❌ Tidak | 255 | - | Subjek/topik pesan |
| `message` | string | ✅ Ya | 5000 | Tidak boleh kosong | Isi pesan lengkap |

---

## ✅ Response Format

### Success Response (200 OK)

Ketika pesan berhasil disimpan ke database.

```json
{
  "success": true,
  "message": "Your message has been sent successfully."
}
```

### Validation Error (422 Unprocessable Entity)

Ketika data tidak lulus validasi.

```json
{
  "success": false,
  "message": "The given data was invalid.",
  "errors": {
    "name": [
      "The name field is required."
    ],
    "email": [
      "The email must be a valid email address."
    ],
    "message": [
      "The message field is required."
    ]
  }
}
```

### Server Error (500 Internal Server Error)

Ketika ada error di server saat menyimpan data.

```json
{
  "success": false,
  "message": "Failed to send message. Please try again later."
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

---

## ✔️ Validasi

### Validasi Field

**Name (Nama)**
- Required (harus ada)
- String
- Maksimum 255 karakter
- Contoh valid: "John Doe", "Budi Santoso"

**Email (Email)**
- Required (harus ada)
- Harus format email yang valid
- Maksimum 255 karakter
- Contoh valid: "john@example.com", "budi@company.co.id"
- Contoh invalid: "john@", "@example.com", "joh n@example.com"

**Subject (Subjek)**
- Optional (boleh kosong)
- String
- Maksimum 255 karakter
- Contoh: "Project Collaboration", "Job Inquiry"

**Message (Pesan)**
- Required (harus ada)
- String
- Maksimum 5000 karakter (~1000 kata)
- Contoh: "I am interested in collaborating on a web development project..."

### Contoh Validasi Error

```json
{
  "success": false,
  "message": "The given data was invalid.",
  "errors": {
    "name": [
      "The name field is required."
    ],
    "email": [
      "The email must be a valid email address.",
      "The email may not be greater than 255 characters."
    ],
    "message": [
      "The message may not be greater than 5000 characters."
    ]
  }
}
```

---

## ❌ Error Handling

### Strategi Error Handling di Frontend

```javascript
const submitContactForm = async (formData) => {
  try {
    const response = await api.post('/contact', formData);
    
    if (response.data.success) {
      // Sukses - tampilkan notifikasi atau redirect
      console.log('Pesan terkirim!');
      showSuccessNotification('Your message has been sent successfully!');
      resetForm();
    }
  } catch (error) {
    if (error.response?.status === 422) {
      // Validation error
      const errors = error.response.data.errors;
      displayValidationErrors(errors);
    } else if (error.response?.status === 401) {
      // API key error
      console.error('Invalid API key');
    } else if (error.response?.status === 500) {
      // Server error
      showErrorNotification('Failed to send message. Please try again later.');
    }
  }
};
```

---

## 💡 Examples

### Example 1: Simple Contact Form (cURL)

```bash
curl -X POST "http://localhost:8000/api/v1/contact?api_key=YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe",
    "email": "john@example.com",
    "subject": "Website Inquiry",
    "message": "Hi, I would like to discuss a potential collaboration."
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "Your message has been sent successfully."
}
```

---

### Example 2: Using Fetch API (JavaScript)

```javascript
const submitContactForm = async (formData) => {
  const apiKey = import.meta.env.VITE_API_KEY;
  
  try {
    const response = await fetch(
      `http://localhost:8000/api/v1/contact?api_key=${apiKey}`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(formData)
      }
    );
    
    const data = await response.json();
    
    if (response.ok && data.success) {
      console.log('Message sent successfully!');
      return { success: true, data };
    } else {
      return { success: false, errors: data.errors };
    }
  } catch (error) {
    console.error('Error:', error);
    return { success: false, error: error.message };
  }
};

// Usage
const formData = {
  name: 'Jane Smith',
  email: 'jane@example.com',
  subject: 'Freelance Project',
  message: 'I have an exciting project that needs your expertise...'
};

const result = await submitContactForm(formData);
```

---

### Example 3: Using Axios (Vue.js/React)

```javascript
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api/v1',
  headers: {
    'X-API-Key': import.meta.env.VITE_API_KEY
  }
});

const submitContact = async (contactData) => {
  try {
    const response = await api.post('/contact', contactData);
    
    if (response.data.success) {
      console.log('Pesan berhasil terkirim!');
      return { success: true };
    }
  } catch (error) {
    if (error.response?.status === 422) {
      // Handle validation errors
      const validationErrors = error.response.data.errors;
      console.error('Validation errors:', validationErrors);
      return { success: false, errors: validationErrors };
    } else {
      console.error('Error sending message:', error);
      return { success: false, error: error.message };
    }
  }
};

export { submitContact };
```

---

### Example 4: Vue 3 Component

```vue
<template>
  <form @submit.prevent="handleSubmit">
    <div>
      <label for="name">Name:</label>
      <input
        v-model="form.name"
        type="text"
        id="name"
        required
      />
      <span v-if="errors.name" class="error">{{ errors.name[0] }}</span>
    </div>

    <div>
      <label for="email">Email:</label>
      <input
        v-model="form.email"
        type="email"
        id="email"
        required
      />
      <span v-if="errors.email" class="error">{{ errors.email[0] }}</span>
    </div>

    <div>
      <label for="subject">Subject:</label>
      <input
        v-model="form.subject"
        type="text"
        id="subject"
      />
    </div>

    <div>
      <label for="message">Message:</label>
      <textarea
        v-model="form.message"
        id="message"
        rows="5"
        required
      ></textarea>
      <span v-if="errors.message" class="error">{{ errors.message[0] }}</span>
    </div>

    <button type="submit" :disabled="isLoading">
      {{ isLoading ? 'Sending...' : 'Send Message' }}
    </button>

    <div v-if="successMessage" class="success">
      {{ successMessage }}
    </div>
  </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const form = ref({
  name: '',
  email: '',
  subject: '',
  message: ''
});

const errors = ref({});
const isLoading = ref(false);
const successMessage = ref('');

const api = axios.create({
  baseURL: 'http://localhost:8000/api/v1',
  headers: {
    'X-API-Key': import.meta.env.VITE_API_KEY
  }
});

const handleSubmit = async () => {
  isLoading.value = true;
  errors.value = {};
  successMessage.value = '';

  try {
    const response = await api.post('/contact', form.value);
    
    if (response.data.success) {
      successMessage.value = response.data.message;
      form.value = { name: '', email: '', subject: '', message: '' };
    }
  } catch (error) {
    if (error.response?.status === 422) {
      errors.value = error.response.data.errors;
    } else {
      successMessage.value = 'Failed to send message. Please try again later.';
    }
  } finally {
    isLoading.value = false;
  }
};
</script>

<style scoped>
.error {
  color: red;
  font-size: 0.875rem;
}

.success {
  color: green;
  padding: 1rem;
  background-color: #f0fdf4;
  border-radius: 0.375rem;
}
</style>
```

---

### Example 5: React Component dengan Formik

```jsx
import { Formik, Form, Field, ErrorMessage } from 'formik';
import * as Yup from 'yup';
import axios from 'axios';

const validationSchema = Yup.object().shape({
  name: Yup.string().required('Name is required').max(255),
  email: Yup.string().email('Invalid email').required('Email is required').max(255),
  subject: Yup.string().max(255),
  message: Yup.string().required('Message is required').max(5000)
});

const ContactForm = () => {
  const api = axios.create({
    baseURL: 'http://localhost:8000/api/v1',
    headers: {
      'X-API-Key': process.env.REACT_APP_API_KEY
    }
  });

  const handleSubmit = async (values, { setSubmitting, resetForm }) => {
    try {
      const response = await api.post('/contact', values);
      
      if (response.data.success) {
        alert('Message sent successfully!');
        resetForm();
      }
    } catch (error) {
      if (error.response?.status === 422) {
        // Handle validation errors
        console.error('Validation errors:', error.response.data.errors);
      }
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <Formik
      initialValues={{
        name: '',
        email: '',
        subject: '',
        message: ''
      }}
      validationSchema={validationSchema}
      onSubmit={handleSubmit}
    >
      {({ isSubmitting }) => (
        <Form>
          <div>
            <label>Name:</label>
            <Field name="name" type="text" />
            <ErrorMessage name="name" component="span" />
          </div>

          <div>
            <label>Email:</label>
            <Field name="email" type="email" />
            <ErrorMessage name="email" component="span" />
          </div>

          <div>
            <label>Subject:</label>
            <Field name="subject" type="text" />
            <ErrorMessage name="subject" component="span" />
          </div>

          <div>
            <label>Message:</label>
            <Field name="message" as="textarea" rows="5" />
            <ErrorMessage name="message" component="span" />
          </div>

          <button type="submit" disabled={isSubmitting}>
            {isSubmitting ? 'Sending...' : 'Send Message'}
          </button>
        </Form>
      )}
    </Formik>
  );
};

export default ContactForm;
```

---

## 📊 Data yang Tersimpan

Pesan kontak yang dikirim akan disimpan ke tabel `contact_messages` dengan struktur:

| Column | Type | Deskripsi |
|--------|------|-----------|
| `id` | increments | Message ID |
| `name` | string | Nama pengirim |
| `email` | string | Email pengirim |
| `subject` | string | Subjek pesan |
| `message` | longText | Isi pesan |
| `status` | enum | Status (unread, read, archived) |
| `created_at` | timestamp | Waktu pesan dikirim |
| `updated_at` | timestamp | Waktu update terakhir |

---

## 🎯 Best Practices

1. **Validasi Client-Side** - Validasi data sebelum mengirim ke server
2. **Show Loading State** - Tampilkan loading indicator saat mengirim
3. **Handle Errors** - Tampilkan pesan error yang user-friendly
4. **Limit Message Length** - Validasi panjang pesan sebelum submit
5. **Rate Limiting** - Pertimbangkan untuk implement rate limiting di frontend
6. **Sanitize Input** - Server akan melakukan sanitasi, tapi client bisa juga
7. **HTTPS Only** - Selalu gunakan HTTPS di production

---

## 🔗 Related

- [Setup & Autentikasi](./01-SETUP-AUTHENTICATION.md)
- [Portfolio API](./02-PORTFOLIO-API.md)
- [Visit API](./04-VISIT-API.md)

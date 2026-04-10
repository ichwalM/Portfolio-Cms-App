<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Throwable;

class ContactController extends Controller
{
    public function store(ContactRequest $request): JsonResponse
    {
        try {
            ContactMessage::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Your message has been sent successfully.',
            ], 200);
        } catch (Throwable $th) {
            report($th);

            return response()->json([
                'success' => false,
                'message' => 'Failed to send message. Please try again later.',
            ], 500);
        }
    }
}

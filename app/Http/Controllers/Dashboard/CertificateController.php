<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::query()
            ->latest('issue_date')
            ->latest('id')
            ->paginate(10);

        return view('dashboard.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('dashboard.certificates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'nullable|date',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:2048',
            'image' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->storeImage($request->file('image'));
        }

        Certificate::create($validated);

        return redirect()->route('dashboard.certificates.index')->with('success', 'Certificate created successfully!');
    }

    public function edit(string $id)
    {
        $certificate = Certificate::findOrFail($id);

        return view('dashboard.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, string $id)
    {
        $certificate = Certificate::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'nullable|date',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:2048',
            'image' => 'nullable|image|max:10240',
        ]);

        if ($request->hasFile('image')) {
            if ($certificate->image) {
                Storage::disk('public')->delete($certificate->image);
            }
            $validated['image'] = $this->storeImage($request->file('image'));
        }

        $certificate->update($validated);

        return redirect()->route('dashboard.certificates.index')->with('success', 'Certificate updated successfully!');
    }

    public function destroy(string $id)
    {
        $certificate = Certificate::findOrFail($id);

        if ($certificate->image) {
            Storage::disk('public')->delete($certificate->image);
        }

        $certificate->delete();

        return back()->with('success', 'Certificate deleted successfully!');
    }

    protected function storeImage($image): string
    {
        if (!Storage::disk('public')->exists('certificates')) {
            Storage::disk('public')->makeDirectory('certificates');
        }

        $filename = 'certificates/' . uniqid('', true) . '.webp';

        Image::read($image)
            ->toWebp(80)
            ->save(storage_path('app/public/' . $filename));

        return $filename;
    }
}

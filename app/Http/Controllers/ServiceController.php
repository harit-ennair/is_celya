<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Helper to compute the image URL from image path.
     */
    protected function formatImageUrl(?string $imagePath): ?string
    {
        if (! $imagePath) {
            return null;
        }

        if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return $imagePath;
        }

        return Storage::url($imagePath);
    }

    /**
     * Display a listing of services.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Service::query();

        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->query('max_price'));
        }

        if ($request->filled('search')) {
            $search = $request->query('search');
            $query->where('name', 'like', "%{$search}%");
        }

        $services = $query->latest()->get()->map(function (Service $service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
                'description' => $service->description,
                'price' => $service->price,
                'duration' => $service->duration,
                'image_path' => $service->image_path,
                'image_url' => $this->formatImageUrl($service->image_path),
                'is_active' => $service->is_active,
                'created_at' => $service->created_at,
            ];
        });

        return response()->json([
            'data' => $services,
        ]);
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration' => ['required', 'integer', 'min:5'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_path' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('services', 'public');
            unset($validated['image']);
        }

        $service = Service::create($validated);

        return response()->json([
            'message' => 'Service created successfully',
            'service' => [
                'id' => $service->id,
                'name' => $service->name,
                'description' => $service->description,
                'price' => $service->price,
                'duration' => $service->duration,
                'image_path' => $service->image_path,
                'image_url' => $this->formatImageUrl($service->image_path),
                'is_active' => $service->is_active,
            ],
        ], 201);
    }

    /**
     * Display the specified service.
     */
    public function show(Service $service): JsonResponse
    {
        return response()->json([
            'service' => [
                'id' => $service->id,
                'name' => $service->name,
                'description' => $service->description,
                'price' => $service->price,
                'duration' => $service->duration,
                'image_path' => $service->image_path,
                'image_url' => $this->formatImageUrl($service->image_path),
                'is_active' => $service->is_active,
                'appointments_count' => $service->appointments()->count(),
            ],
        ]);
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Service $service): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'duration' => ['sometimes', 'required', 'integer', 'min:5'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_path' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            if ($service->image_path && Storage::disk('public')->exists($service->image_path)) {
                Storage::disk('public')->delete($service->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('services', 'public');
            unset($validated['image']);
        }

        $service->update($validated);

        return response()->json([
            'message' => 'Service updated successfully',
            'service' => [
                'id' => $service->id,
                'name' => $service->name,
                'description' => $service->description,
                'price' => $service->price,
                'duration' => $service->duration,
                'image_path' => $service->image_path,
                'image_url' => $this->formatImageUrl($service->image_path),
                'is_active' => $service->is_active,
            ],
        ]);
    }

    /**
     * Toggle active status of service.
     */
    public function toggleStatus(Service $service): JsonResponse
    {
        $service->update(['is_active' => ! $service->is_active]);

        return response()->json([
            'message' => 'Service status updated successfully',
            'is_active' => $service->is_active,
        ]);
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Service $service): JsonResponse
    {
        if ($service->image_path && Storage::disk('public')->exists($service->image_path)) {
            Storage::disk('public')->delete($service->image_path);
        }

        $service->delete();

        return response()->json([
            'message' => 'Service deleted successfully',
        ]);
    }
}

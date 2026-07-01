<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRetailerRequest;
use App\Services\Retailer\RetailerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Models\Retailer;

use App\Http\Requests\Admin\UpdateRetailerRequest;

class RetailerController extends Controller
{
    /**
     * Retailer Service
     */
    protected RetailerService $retailerService;

    /**
     * Constructor
     */
    public function __construct(RetailerService $retailerService)
    {
        $this->retailerService = $retailerService;
    }

    /**
     * Retailer Listing
     */
    public function index(): View
    {
        return view('admin.retailers.index');
    }

    /**
     * DataTable AJAX
     */
    public function datatable(): JsonResponse
    {
        return $this->retailerService->datatable();
    }

    /**
     * Show Create Form
     */
    public function create(): View
    {
        return view('admin.retailers.create');
    }

    /**
     * Store Retailer
     */
    public function store(StoreRetailerRequest $request): RedirectResponse
    {
        try {

            $this->retailerService->createRetailer(
                $request->validated()
            );

            return redirect()
                ->route('admin.retailers.index')
                ->with('success', 'Retailer created successfully.');

        } catch (\Throwable $exception) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $exception->getMessage());

        }
    }

    /**
     * Show Retailer
     */
/**
 * Display Retailer Details
 */
public function show(Retailer $retailer): View
{
    $retailer = $this->retailerService->getRetailer($retailer);

    return view('admin.retailers.show', compact('retailer'));
}

    /**
     * Edit Retailer
     */
 public function edit(Retailer $retailer): View
{
    $retailer = $this->retailerService->getRetailer($retailer);

    return view('admin.retailers.edit', compact('retailer'));
}
    /**
     * Update Retailer
     */
  public function update(
    UpdateRetailerRequest $request,
    Retailer $retailer
): RedirectResponse {

    $this->retailerService->updateRetailer(
        $retailer,
        $request->validated()
    );

    return redirect()
        ->route('admin.retailers.index')
        ->with('success', 'Retailer updated successfully.');
}

    /**
     * Delete Retailer
     */
public function destroy(Retailer $retailer): JsonResponse
{
    try {

        $this->retailerService->deleteRetailer($retailer);

        return response()->json([
            'success' => true,
            'message' => 'Retailer deleted successfully.',
        ]);

    } catch (\Throwable $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);

    }
}
}
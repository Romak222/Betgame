<?php

namespace App\Services\Retailer;

use App\Models\Retailer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\UpdateRetailerRequest;

class RetailerService
{
    /**
     * DataTable Listing
     */
    public function datatable(): JsonResponse
    {
        $query = Retailer::with('user')
            ->select('retailers.*')
            ->latest();

        return DataTables::eloquent($query)

            ->addIndexColumn()

            ->addColumn('login_id', function (Retailer $retailer) {
                return $retailer->user->login_id ?? '-';
            })

            ->addColumn('status_badge', function (Retailer $retailer) {

                return $retailer->status
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';
            })

            ->addColumn('action', function (Retailer $retailer) {

                return '
                    <a href="' . route('admin.retailers.show', $retailer->id) . '" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>

                    <a href="' . route('admin.retailers.edit', $retailer->id) . '" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>

                    <button
                        type="button"
                        class="btn btn-danger btn-sm btn-delete"
                        data-id="' . $retailer->id . '">
                        <i class="fas fa-trash"></i>
                    </button>
                ';
            })

            ->rawColumns([
                'status_badge',
                'action',
            ])

            ->make(true);
    }

    /**
     * Create Retailer
     */
  

public function createRetailer(array $data): Retailer
{
            return DB::transaction(function () use ($data) {

                // Generate IDs
                $loginId = $this->generateRetailerLoginId();
                $shopCode = $this->generateShopCode();

                // Create User
                $user = User::create([
                    'username'      => $data['username'],
                    'login_id'      => $loginId,
                    'email'         => $data['email'] ?? null,
                    'password' => $data['password'],
                    'status'        => $data['status'],
                    'last_login_at' => null,
                ]);

                // Assign Retailer Role
                $user->assignRole('Retailer');

                // Create Retailer
                return Retailer::create([
                    'user_id'           => $user->id,
                    'shop_name'         => $data['shop_name'],
                    'shop_code'         => $shopCode,
                    'owner_name'        => $data['owner_name'],
                    'mobile'            => $data['mobile'],
                    'alternate_mobile'  => $data['alternate_mobile'] ?? null,
                    'address'           => $data['address'],
                    'city'              => $data['city'],
                    'state'             => $data['state'],
                    'pincode'           => $data['pincode'],
                    'margin'            => $data['margin'],
                    'daily_limit'       => $data['daily_limit'],
                    'status'            => $data['status'],
                    'notes'             => $data['notes'] ?? null,
                    'last_login'        => null,
                ]);
            });
}
/**
 * Get Retailer Details
 */
public function getRetailer(Retailer $retailer): Retailer
{
    return $retailer->load('user');
}

    /**
     * Generate Login ID
     *
     * Example:
     * RT000001
     */
    private function generateRetailerLoginId(): string
    {
        $lastUser = User::whereNotNull('login_id')
            ->where('login_id', 'LIKE', 'RT%')
            ->latest('id')
            ->first();

        if (!$lastUser) {
            return 'RT000001';
        }

        $number = (int) substr($lastUser->login_id, 2);

        return 'RT' . str_pad($number + 1, 6, '0', STR_PAD_LEFT);
    }

    /**
 * Update Retailer
 */
public function updateRetailer(Retailer $retailer, array $data): Retailer
{
    return DB::transaction(function () use ($retailer, $data) {

        $user = $retailer->user;

        $user->username = $data['username'];

        $user->email = $data['email'];

        $user->status = $data['status'];

        if (!empty($data['password'])) {
            $user->password = $data['password']; // auto hashed
        }

        $user->save();

        $retailer->update([

            'shop_name' => $data['shop_name'],

            'owner_name' => $data['owner_name'],

            'mobile' => $data['mobile'],

            'alternate_mobile' => $data['alternate_mobile'],

            'address' => $data['address'],

            'city' => $data['city'],

            'state' => $data['state'],

            'pincode' => $data['pincode'],

            'margin' => $data['margin'],

            'daily_limit' => $data['daily_limit'],

            'status' => $data['status'],

            'notes' => $data['notes'],

        ]);

        return $retailer->fresh('user');
    });
}

/**
 * Delete Retailer
 */
public function deleteRetailer(Retailer $retailer): void
{
    DB::transaction(function () use ($retailer) {

        $user = $retailer->user;

        $retailer->delete();

        if ($user) {
            $user->delete();
        }

    });
}

    /**
     * Generate Shop Code
     *
     * Example:
     * SHOP000001
     */
    private function generateShopCode(): string
    {
        $lastRetailer = Retailer::latest('id')->first();

        if (!$lastRetailer) {
            return 'SHOP000001';
        }

        $number = (int) substr($lastRetailer->shop_code, 4);

        return 'SHOP' . str_pad($number + 1, 6, '0', STR_PAD_LEFT);
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
            'message' => 'Retailer deleted successfully.'
        ]);

    } catch (\Throwable $e) {

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);

    }
}
}
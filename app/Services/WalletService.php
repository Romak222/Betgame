<?php

namespace App\Services;

use App\Models\Retailer;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Exception;
use Illuminate\Support\Facades\DB;

class WalletService
{
    public function getOrCreateWallet(Retailer $retailer): Wallet
    {
        return Wallet::firstOrCreate(
            ['retailer_id' => $retailer->id],
            [
                'balance' => 0,
                'hold_balance' => 0,
                'total_credit' => 0,
                'total_debit' => 0,
                'is_active' => true,
            ]
        );
    }

    public function debitForBet(Retailer $retailer, float $amount, string $referenceType = null, int $referenceId = null): Wallet
    {
        return DB::transaction(function () use ($retailer, $amount, $referenceType, $referenceId) {

            $wallet = $this->getLockedWallet($retailer);

            if (!$wallet->is_active) {
                throw new Exception('Wallet is inactive.');
            }

            if ($wallet->balance < $amount) {
                throw new Exception('Insufficient wallet balance.');
            }

            $before = (float) $wallet->balance;
            $after = $before - $amount;

            $wallet->update([
                'balance' => $after,
                'total_debit' => (float) $wallet->total_debit + $amount,
            ]);

            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'retailer_id' => $retailer->id,
                'type' => 'DEBIT',
                'purpose' => 'BET',
                'amount' => $amount,
                'balance_before' => $before,
                'balance_after' => $after,
                'reference_type' => $referenceType,
                'reference_id' => $referenceId,
                'remarks' => 'Bet amount deducted',
            ]);

            return $wallet->fresh();
        });
    }

    public function creditWin(Retailer $retailer, float $amount, string $referenceType = null, int $referenceId = null): Wallet
    {
        return DB::transaction(function () use ($retailer, $amount, $referenceType, $referenceId) {

            $wallet = $this->getLockedWallet($retailer);

            if (!$wallet->is_active) {
                throw new Exception('Wallet is inactive.');
            }

            $before = (float) $wallet->balance;
            $after = $before + $amount;

            $wallet->update([
                'balance' => $after,
                'total_credit' => (float) $wallet->total_credit + $amount,
            ]);

            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'retailer_id' => $retailer->id,
                'type' => 'CREDIT',
                'purpose' => 'WIN',
                'amount' => $amount,
                'balance_before' => $before,
                'balance_after' => $after,
                'reference_type' => $referenceType,
                'reference_id' => $referenceId,
                'remarks' => 'Winning amount credited',
            ]);

            return $wallet->fresh();
        });
    }

    public function deposit(Retailer $retailer, float $amount, string $remarks = null): Wallet
    {
        return DB::transaction(function () use ($retailer, $amount, $remarks) {

            $wallet = $this->getLockedWallet($retailer);

            $before = (float) $wallet->balance;
            $after = $before + $amount;

            $wallet->update([
                'balance' => $after,
                'total_credit' => (float) $wallet->total_credit + $amount,
            ]);

            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'retailer_id' => $retailer->id,
                'type' => 'CREDIT',
                'purpose' => 'DEPOSIT',
                'amount' => $amount,
                'balance_before' => $before,
                'balance_after' => $after,
                'remarks' => $remarks ?? 'Wallet deposit',
            ]);

            return $wallet->fresh();
        });
    }

    private function getLockedWallet(Retailer $retailer): Wallet
    {
        $this->getOrCreateWallet($retailer);

        return Wallet::where('retailer_id', $retailer->id)
            ->lockForUpdate()
            ->firstOrFail();
    }
}
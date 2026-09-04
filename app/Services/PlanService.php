<?php

declare(strict_types=1);

namespace App\Services;

class PlanService
{
    public const PLANS = [
        'mvp' => [
            'name' => 'MVP / Degustação (7 dias)',
            'price' => 0.00,
            'trial_days' => 7,
            'max_products' => 20,
            'kds_enabled' => false,
            'reports_enabled' => false,
            'coupons_enabled' => true,
        ],
        'starter' => [
            'name' => 'Starter',
            'price' => 49.00,
            'trial_days' => null,
            'max_products' => null,
            'kds_enabled' => false,
            'reports_enabled' => false,
            'coupons_enabled' => true,
        ],
        'pro' => [
            'name' => 'Pro',
            'price' => 99.00,
            'trial_days' => null,
            'max_products' => null,
            'kds_enabled' => true,
            'reports_enabled' => true,
            'coupons_enabled' => true,
        ],
        'enterprise' => [
            'name' => 'Enterprise',
            'price' => null,
            'trial_days' => null,
            'max_products' => null,
            'kds_enabled' => true,
            'reports_enabled' => true,
            'coupons_enabled' => true,
        ],
    ];

    public static function getPlanDetails(string $planKey): array
    {
        return self::PLANS[$planKey] ?? self::PLANS['mvp'];
    }

    public static function isTrialExpired(array $tenant): bool
    {
        $plan = (string) ($tenant['plano'] ?? 'mvp');
        if ($plan !== 'mvp') {
            return false;
        }

        $createdAt = !empty($tenant['criado_em']) ? new \DateTimeImmutable($tenant['criado_em']) : new \DateTimeImmutable();
        $now = new \DateTimeImmutable();
        $diff = $now->diff($createdAt)->days;

        return $diff >= 7;
    }
}

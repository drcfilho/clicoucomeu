<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\CouponRepository;
use DateTime;

class CouponService
{
    public function __construct(private CouponRepository $couponRepo)
    {
    }

    public function validateAndCalculate(int $tenantId, string $code, float $subtotal, float $deliveryFee = 0.0): array
    {
        $coupon = $this->couponRepo->findByCode($tenantId, $code);

        if (!$coupon) {
            return ['valid' => false, 'message' => 'Cupom inválido ou expirado.'];
        }

        // 1. Validação de Valor Mínimo
        if ($coupon['valor_minimo'] !== null && $subtotal < (float) $coupon['valor_minimo']) {
            return [
                'valid' => false,
                'message' => sprintf('Cupom válido apenas para pedidos a partir de R$ %s.', number_format((float) $coupon['valor_minimo'], 2, ',', '.')),
            ];
        }

        // 2. Validação de Período de Validade
        $now = new DateTime();
        if (!empty($coupon['data_inicio']) && $now < new DateTime($coupon['data_inicio'])) {
            return ['valid' => false, 'message' => 'Este cupom ainda não está ativo.'];
        }

        if (!empty($coupon['data_fim']) && $now > new DateTime($coupon['data_fim'])) {
            return ['valid' => false, 'message' => 'Este cupom já expirou.'];
        }

        // 3. Validação de Limite de Usos
        if ($coupon['limite_usos'] !== null && (int) $coupon['usos'] >= (int) $coupon['limite_usos']) {
            return ['valid' => false, 'message' => 'Limite de usos deste cupom esgotado.'];
        }

        // 4. Cálculo do Desconto
        $discount = 0.0;
        $type = (string) $coupon['tipo'];

        if ($type === 'percentual') {
            $discount = round(($subtotal * (float) $coupon['valor']) / 100, 2);
        } elseif ($type === 'valor') {
            $discount = min($subtotal, (float) $coupon['valor']);
        } elseif ($type === 'frete_gratis') {
            $discount = $deliveryFee;
        }

        return [
            'valid' => true,
            'coupon' => $coupon,
            'discount' => $discount,
            'message' => 'Cupom aplicado com sucesso!',
        ];
    }
}

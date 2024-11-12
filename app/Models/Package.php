<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Package extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'tracking_code',
        'commune_id',
        'delivery_type_id',
        'status_id',
        'store_id',
        'address',
        'can_be_opened',
        'name',
        'client_first_name',
        'client_last_name',
        'client_phone',
        'client_phone2',
        'cod_to_pay',
        'commission',
        'delivery_price',
        'extra_weight_price',
        'free_delivery',
        'packaging_price',
        'partner_cod_price',
        'partner_delivery_price',
        'partner_return',
        'price',
        'price_to_pay' ,
        'return_price',
        'total_price',
        'weight',
    ];

    /**
     * @return BelongsTo
     */
    public function commune(): BelongsTo
    {
        return $this->belongsTo(Commune::class);
    }

    /**
     * @return BelongsTo
     */
    public function deliveryType(): BelongsTo
    {
        return $this->belongsTo(DeliveryType::class);
    }

    /**
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(PackageStatus::class);
    }

    /**
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}

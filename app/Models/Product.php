<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'sku',
        'stock',
        'price',
        'discount_percentage',
        'quantity',
        'status',
        'is_featured',
        'description',
    ];

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'products_colors');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'products_sizes');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['colors'])) {
            $colorIds = is_array($filters['colors']) ? $filters['colors'] : explode(',', $filters['colors']);
            $query->whereHas('colors', function ($q) use ($colorIds) {
                $q->whereIn('colors.id', $colorIds);
            });
        }

        if (isset($filters['sizes'])) {
            $sizeIds = is_array($filters['sizes']) ? $filters['sizes'] : explode(',', $filters['sizes']);
            $query->whereHas('sizes', function ($q) use ($sizeIds) {
                $q->whereIn('sizes.id', $sizeIds);
            });
        }

        if (isset($filters['categories'])) {
            $categoryIds = is_array($filters['categories']) ? $filters['categories'] : explode(',', $filters['categories']);
            $query->whereHas('categories', function ($q) use ($categoryIds) {
                $q->whereIn('categories.id', $categoryIds);
            });
        }

        if (isset($filters['stock'])) {
            if ($filters['stock'] === 'in_stock') {
                $query->where('stock', 'instock');
            } elseif ($filters['stock'] === 'out_of_stock') {
                $query->where('stock', 'outofstock');
            }
        }

        if (isset($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }

        if (isset($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }

        if (isset($filters['sort_by'])) {
            switch ($filters['sort_by']) {
                case 'newest':
                    $query->orderByDesc('created_at');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'best_selling':
                    $query->withSum('orderItems', 'quantity')
                          ->orderByRaw('COALESCE(order_items_sum_quantity, 0) DESC')
                          ->orderByDesc('is_featured')
                          ->orderByDesc('discount_percentage')
                          ->orderByDesc('created_at');
                default:
                    $query->withSum('orderItems', 'quantity')
                          ->orderByRaw('COALESCE(order_items_sum_quantity, 0) DESC')
                          ->orderByDesc('is_featured')
                          ->orderByDesc('discount_percentage')
                          ->orderByDesc('created_at');
                    break;
            }
        } else {
            $query->withSum('orderItems', 'quantity')
                  ->orderByRaw('COALESCE(order_items_sum_quantity, 0) DESC')
                  ->orderByDesc('is_featured')
                  ->orderByDesc('discount_percentage')
                  ->orderByDesc('created_at');
        }

        return $query;
    }
}

<?php

namespace App\Http\Filter;

use App\Http\Filter\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{

    public const CATEGORIES = 'categories';
    public const COLORS = 'colors';
    public const PRICES = 'prices';
    public const TAGS = 'tags';

    protected function getCallbacks(): array
    {
        return
            [
                self::CATEGORIES => [$this, 'categories'],
                self::COLORS => [$this, 'colors'],
                self::PRICES => [$this, 'prices'],
                self::TAGS => [$this, 'tags'],
            ];
    }

    protected function categories(Builder $builder, $value)
    {
        $builder->whereIn('category_id', $value);
    }

    protected function colors(Builder $builder, $value)
    {
        $builder->whereHas('colors', function ($b) use ($value) {
            $b->whereIn('color_id', $value);
        });
    }

    protected function prices(Builder $builder, $value)
    {
        $builder->whereBetween('price', $value);
        if ($this->getQueryParam('sortOptions') !== null && $this->getQueryParam('sortOptions')[0] == 'price') {
            $builder->orderBy('price', $this->getQueryParam('sortOptions')[1]);
        }
    }

    protected function tags(Builder $builder, $value)
    {
        $builder->whereHas('tags', function ($b) use ($value) {
            $b->whereIn('tag_id', $value);
        });
    }
}

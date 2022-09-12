<?php

namespace App\Traits;

use App\Models\User;

trait ModelTrait
{

    // search query for all models with count for pagination
    public function scopeSearched($query)
    {

        $search = request()->query('search');
        $count = request()->query('count');


        if (!$search) {
            return $query->orderByDesc('created_at')->simplePaginate($count ? $count : 10);
        }


        // search query
        return $query->where(function ($query) use($search) {
                        $query
                            ->where('title', 'LIKE', "%{$search}%")
                            ->orWhere('name', 'LIKE', "%{$search}%")
                            ->orWhere('description', 'LIKE', "%{$search}%");
                    })
                    ->orderByDesc('created_at')
                    ->simplePaginate($count ? $count : 10);
        // end of search query section

    }


}

<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;

class UpdateController extends Controller
{
    public function __invoke(StoreRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        return redirect()->route('category.index');
    }
}

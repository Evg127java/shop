<?php

namespace App\Http\Controllers\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\StoreRequest;
use App\Models\Tag;

class UpdateController extends Controller
{
    public function __invoke(StoreRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $tag->update($data);
        return redirect()->route('tag.index');
    }
}

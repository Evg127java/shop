<?php

namespace App\Http\Controllers\Color;

use App\Http\Controllers\Controller;
use App\Http\Requests\Color\StoreRequest;
use App\Models\Color;

class UpdateController extends Controller
{
    public function __invoke(StoreRequest $request, Color $color)
    {
        $data = $request->validated();
        $color->update($data);
        return redirect()->route('color.index');
    }
}

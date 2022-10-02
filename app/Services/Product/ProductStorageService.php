<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Processes post data
 */
class ProductStorageService implements ProductProcessInterface
{
    /**
     *  Processes extra specified data to store a post
     *
     * @param $data
     * @return void
     */
    public function store(array $data)
    {
        try {
            Db::beginTransaction();

            /* Save the image's preview to the storage and get its url */
            $data['preview_image'] = isset($data['preview_image']) ?
                Storage::disk('public')->put('/images', $data['preview_image']) :
                null
            ;

            /* Check if there are any tags and colors in the input, remember it for the following processing and unset it */
            if (array_key_exists('tags', $data)) {
                $tags = $data['tags'];
                unset($data['tags']);
            }
            if (array_key_exists('colors', $data)) {
                $colors = $data['colors'];
                unset($data['colors']);
            }
            $data['is_published'] = 0;
            $product = Product::create($data);

            /* If tags and colors are existed add them to the current product */
            if (isset($tags)) {
                $product->tags()->attach($tags);
            }
            if (isset($colors)) {
                $product->colors()->attach($colors);
            }
            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            abort(500);
        }
    }

    /**
     * Processes extra specified data to update a post
     *
     * @param $data
     * @param $product
     * @return mixed
     */
    public function update(array $data, Product $product)
    {
        try {
            Db::beginTransaction();
            /* Save the image's preview to the storage and get its url */
            $data['preview_image'] = isset($data['preview_image']) ?
                Storage::disk('public')->put('/images', $data['preview_image']) :
                $product->preview_image;

            /* Check if the input data has tags and colors and process them */
            $tags = array_key_exists('tags', $data) ? $data['tags'] : [];
            $colors = array_key_exists('colors', $data) ? $data['colors'] : [];
            unset($data['tags'], $data['colors']);

            $product->update($data);
            $product->tags()->sync($tags);
            $product->colors()->sync($colors);
            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            abort(500);
        }
        return $product;
    }

    public function delete(Product $product)
    {
        try {
            Db::beginTransaction();

            $product->tags()->detach();
            $product->colors()->detach();
            if (isset ($product->preview_image)) {
                Storage::disk('public')->delete($product->preview_image);
            }
            $product->delete();

            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            abort(500);
        }
    }
}

<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Services\Image\ProductImageService;
use Illuminate\Support\Facades\DB;

/**
 * Processes product data
 */
class ProductService implements ProductServiceInterface
{
    /**
     *  Processes specified data to store a product
     *
     * @param $data
     * @return void
     */
    public function store($data)
    {

        try {
            Db::beginTransaction();

            /* Get the product's image preview path  */
            $data['preview_image'] = isset($data['preview_image']) ?
                ProductImageService::putImageToStorage($data['preview_image']) : null
            ;

            /* Remember and unset main product images from the input */
            if (isset($data['product_images'])) {
                $imagesFromInput = $data['product_images'];
                unset($data['product_images']);
            }

            /* Check if there are any tags and colors in the input, remember it for the following processing and unset it */
            $tags = array_key_exists('tags', $data) ? $data['tags'] : [];
            $colors = array_key_exists('colors', $data) ? $data['colors'] : [];
            unset($data['tags'], $data['colors']);

            $data['is_published'] = 0;
            $product = Product::create($data);

            /* Link images to the created product if they exist */
            if (isset($imagesFromInput)) {
                ProductImageService::linkImagesToProduct($imagesFromInput, $product->id);
            }
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
            abort(500, $e->getMessage());
        }
    }

    /**
     * Processes extra specified data to update a product
     *
     * @param $data
     * @param $product
     * @return mixed
     */
    public function update($data, $product)
    {
        try {
            Db::beginTransaction();

            /* Get a new path for a new preview or get the old one from the current product */
            $data['preview_image'] = isset($data['preview_image']) ?
                ProductImageService::putImageToStorage($data['preview_image']) :
                $product->preview_image
            ;

            /* If the input data has images, and the product had images remove product linked images */
            if (isset($data['product_images'])) {
                $imagesFromInput = $data['product_images'];
                if ($productImagesSet = $product->images) {
                    if (ProductImageService::checkIfDirExistsInStorage($product->id)) {
                        ProductImageService::removeDirFromStorage($product->id);
                    }
                    ProductImageService::removeImagesObjectsFromDb($productImagesSet->pluck('id'));
                }
                unset($data['product_images']);
            }

            /* Check if the input data has tags and colors and process them */
            $tags = array_key_exists('tags', $data) ? $data['tags'] : [];
            $colors = array_key_exists('colors', $data) ? $data['colors'] : [];
            unset($data['tags'], $data['colors']);


            $product->update($data);
            $product->tags()->sync($tags);
            $product->colors()->sync($colors);

            /* Save new product's images into the storage and kink them to the current product */
            if (isset($imagesFromInput)) {
                ProductImageService::linkImagesToProduct($imagesFromInput, $product->id);
            }
            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            abort(500);
        }
        return $product;
    }


    /**
     *  Deletes product and linked data to it
     *
     * @param $product
     * @return void
     */
    public function delete($product)
    {
        try {
            Db::beginTransaction();

            $product->tags()->detach();
            $product->colors()->detach();

            /* Remove the product's preview image if the product has it */
            if (isset ($product->preview_image)) {
                $preview_image = $product->preview_image;
                ProductImageService::removeImageFromStorage($preview_image);
            }
            /* Remove the product's main image if the product has them */
            ProductImageService::removeDirFromStorage($product->id);
            $product->delete();

            Db::commit();
        } catch (\Exception $e) {
            Db::rollBack();
            abort(500);
        }
    }
}

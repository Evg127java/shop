<?php

namespace App\Services\Image;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

/**
 * Processes images related to products
 */
class ProductImageService
{
    /**
     * Using "disk" settings to deal with the Storage
     */
    public const disk = 'public';
    /**
     * The folder name in the Storage for storing all images
     */
    public const path = '/images';


    /**
     * Puts the only image into the Storage and returns a path to the image in the Storage
     *
     * @param $image
     * @return bool returns a path to the passed image
     */
    public static function putImageToStorage($image)
    {
        return Storage::disk(self::disk)->put(self::path, $image);
    }

    /**
     * Puts th passed images into the Storage and makes objects for them linked to the specified product
     *
     * @param array $images
     * @param int $productId
     * @return void
     */
    public static function linkImagesToProduct(array $images, int $productId)
    {
        foreach ($images as $imageId => $productImage) {
            $path = self::path . "/$productId/$imageId";
            $productImageUrl = [];
            $productImageUrl['product_id'] = $productId;
            $productImageUrl["image_id"] = $imageId;
            $productImageUrl["image_url"] = Storage::disk(self::disk)->put($path, $productImage);
            ProductImage::create($productImageUrl);
        }
    }

    /**
     * Checks if the folder exists in the storage linked to the specified product
     *
     * @param int $productId
     * @return bool true if exists
     */
    public static function checkIfDirExistsInStorage(int $productId)
    {
        return Storage::disk(self::disk)->exists(self::path . "/{$productId}");
    }

    /**
     * Checks if the specified image exists in the Storage
     *
     * @param string $image
     * @return bool true if exists
     */
    public static function checkIfImageExistsInStorage(string $image)
    {
        return Storage::disk(self::disk)->exists($image);
    }

    /**
     * Removes the whole folder of images for the specified product
     *
     * @param int $productId
     * @return void
     */
    public static function removeDirFromStorage(int $productId)
    {
        if (self::checkIfDirExistsInStorage($productId)) {
            Storage::disk(self::disk)->deleteDirectory(self::path . "/$productId");
        }
    }

    /**
     * Removes the specified images' objects from the database
     *
     * @param $imagesIdsSet
     * @return void
     */
    public static function removeImagesObjectsFromDb($imagesIdsSet)
    {
        ProductImage::destroy($imagesIdsSet);
    }

    /**
     * Removes the only specified image from the storage
     *
     * @param string $imageName
     * @return void
     */
    public static function removeImageFromStorage(string $imageName)
    {
        if (self::checkIfImageExistsInStorage($imageName)) {
            Storage::disk(self::disk)->delete($imageName);
        }
    }

}

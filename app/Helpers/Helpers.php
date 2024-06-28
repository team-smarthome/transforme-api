<?php 

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Helpers
{
    public static function HandleImageBase64($imageRequest){
    if (strpos($imageRequest, 'data:image/jpeg;base64,') === 0) {
        $imageRequest = str_replace('data:image/jpeg;base64,', '', $imageRequest);
    } elseif (strpos($imageRequest, 'data:image/png;base64,') === 0) {
        $imageRequest = str_replace('data:image/png;base64,', '', $imageRequest);
    }

    // Decode the base64 image string
    $image = base64_decode($imageRequest);

    // Generate a random filename with .png extension
    $filename = 'wbp-images/' . Str::random(10) . '.png';

    // Save the image to the public disk
    Storage::disk('public')->put($filename, $image);

    // Generate the URL for the saved image
    $url = Storage::url($filename);

    return $url;
    }
    
    public static function HandleImageToBase64($imageRequest, $folder){
        if (strpos($imageRequest, 'data:image/jpeg;base64,') === 0) {
            $imageRequest = str_replace('data:image/jpeg;base64,', '', $imageRequest);
        } elseif (strpos($imageRequest, 'data:image/png;base64,') === 0) {
            $imageRequest = str_replace('data:image/png;base64,', '', $imageRequest);
        }
    
        // Decode the base64 image string
        $image = base64_decode($imageRequest);
    
        // Generate a random filename with .png extension
        // $filename = 'wbp-images/' . Str::random(10) . '.png';
        $filename = $folder . '/' . Str::random(10) . '.png';
    
        // Save the image to the public disk
        Storage::disk('public')->put($filename, $image);
    
        // Generate the URL for the saved image
        $url = Storage::url($filename);
    
        return $url;
        }

}
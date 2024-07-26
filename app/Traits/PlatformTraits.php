<?php

namespace App\Traits\GlobalTraits;

use App\Models\SikapModel\Platform;

trait PlatformTraits
{
    public function sikapPlatformId()
    {
        // $platform = config('app.platform_id');
        // return $platform;

        $platform = Platform::where('platform', '=', 'sikap')->first();
        return $platform->id;
    }

    public function gemaPlatformId()
    {
        $platform = Platform::where('platform', '=', 'gema')->first();
        return $platform->id;
    }
}

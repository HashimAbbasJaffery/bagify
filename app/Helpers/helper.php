<?php

use App\Enum\Status;
use App\Models\WebsiteLayout\Layout;
use Illuminate\Support\Facades\Cache;

if(!function_exists("getHeader")) {
    function getHeader(): string {
        return 'layout.parts.header';
    }
}

if(!function_exists("getFooter")) {
    function getFooter(): string {
        return 'layout.parts.footer';
    }
}

if(!function_exists("layout")) {
    function layout() {
        Cache::delete("layout");
        return Cache::rememberForever("layout", function() {
            $layout = Layout::with("header", "footer", "banner", "arrangement.section")
                            ->where("status", Status::Active->value)
                            ->first();
            return $layout;
        });
    }

}
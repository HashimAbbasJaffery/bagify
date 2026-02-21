<?php

namespace App\Models\WebsiteLayout;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    protected $table = "website_layout";
    public function header() {
        return $this->belongsTo(Header::class);
    }
    public function footer() {
        return $this->belongsTo(Footer::class);
    }
    public function banner() {
        return $this->belongsTo(Banner::class);
    }
    public function arrangement() {
        return $this->hasMany(SectionArrangement::class, "website_layout_id")->orderBy("order");
    }
}

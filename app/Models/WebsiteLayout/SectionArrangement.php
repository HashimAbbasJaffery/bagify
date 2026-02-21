<?php

namespace App\Models\WebsiteLayout;

use Illuminate\Database\Eloquent\Model;

class SectionArrangement extends Model
{
    protected $table = "section_arrangement";
    public function layout() {
        return $this->belongsTo(Layout::class);
    }

    public function section() {
        return $this->belongsTo(Section::class, "section_id");
    }
}

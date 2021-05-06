<?php

namespace App\Exports;

use App\Inquiry;
use Maatwebsite\Excel\Concerns\FromCollection;

class InquiriesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	return !empty($this->type) ? Inquiry::where('type', $this->type)->get() : Inquiry::all();
    }
}

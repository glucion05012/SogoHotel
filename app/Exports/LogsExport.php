<?php

namespace App\Exports;

use App\Activity_log;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class LogsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

    	$item = Activity_log::select('created_at', 'description', 'subject_type', 'causer_id')->get();
    	$item->map(function($data){
            return $data->user = User::withTrashed()->where('id', $data->causer_id)->first()->email;
        });

        return $item;
    }
}

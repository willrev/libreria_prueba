<?php

namespace App\Exports;

use App\Models\Libro;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LibroExport implements FromView, ShouldAutoSize 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view ('libro\libros',[
            'libro' => Libro::all()
        ]);
    }
    
}

<?php

namespace App\Imports;

use App\Models\Libro;
use App\Models\Categoria;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;




class LibroImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation 

{
    private $categories;
    public function __construct()
    {
        $this->categories = Categoria::pluck('id', 'name');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Libro([
            'categoria_id' =>$this->categories[$row['categoria']],
            'name' => $row['nombre'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

//      validación de los campos de encabezados.
public function rules(): array
{
    return [
        '*.categoria' => [
            
                        'categorias' => 'exists:categorias,name',//valida que el campo exista en una tabla.
                        'required',
                        'string',
                         ],

         '*.nombre' => [
                    'required',
                    'string',
                    ]
        ];
    }     
   
}

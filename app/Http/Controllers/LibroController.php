<?php

namespace App\Http\Controllers;

use App\Exports\LibroExport;
use App\Imports\LibroImport;

use App\Models\Libro;
use App\Models\Categoria;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;  
use PDF;



/**
 * Class LibroController
 * @package App\Http\Controllers
 */
class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $libros = Libro::paginate();

        return view('libro.index', compact('libros'))
            ->with('i', (request()->input('page', 1) - 1) * $libros->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $libro = new Libro();

        $categorias= Categoria::pluck('name', 'id');

        return view('libro.create', compact('libro','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
        request()->validate(Libro::$rules);

        $libro = Libro::create($request->all());

        return redirect()->route('libros.index')
            ->with('success', 'Libro created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $libro = Libro::find($id);

        return view('libro.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $libro = Libro::find($id);
                
        $categorias= Categoria::pluck('name', 'id');

        return view('libro.edit', compact('libro','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Libro $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        request()->validate(Libro::$rules);

        $libro->update($request->all());

        return redirect()->route('libros.index')
            ->with('success', 'Libro updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $libro = Libro::find($id)->delete();

        return redirect()->route('libros.index')
            ->with('success', 'Libro deleted successfully');
    }

    /* Funcion para Exportar datos de la tabla libros*/
    public function exportExcel()
    {
        return Excel::download(new LibroExport, 'libro.xlsx');
    }

    /* Funcion para importar datos a la tabla libros*/
    public function importExcel(Request $request)
    
    {
        $file = $request->file('file');
        Excel::import(new LibroImport, $file);
        return redirect()->route('libros.index')->with('success', 'Importación de Libros Exitosa');
    }

    
    public function pdf()
    {
        $libros = Libro::paginate();
        $pdf = FacadePdf::loadView('libro.pdf',['libros'=>$libros]);  
        return $pdf->stream(); /*Muestra el documento pdf.*/       
        //return $pdf->download('libro.pdf');/*Descrga el documento pdf*/
    }

    public function descargarpdf()
    {
        $libros = Libro::paginate();
        $pdf = FacadePdf::loadView('libro.pdf',['libros'=>$libros]);  
        //return $pdf->stream(); /*Muestra el documento pdf.*/       
        return $pdf->download('libro.pdf');/*Descrga el documento pdf*/
    }
}

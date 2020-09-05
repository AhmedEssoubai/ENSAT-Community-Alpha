<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('pending');
    }

    /**
     * Download resource file
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function resource(File $file)
    {
        return Storage::download('public/uploads/resources/' . $file->url, $file->name);
    }

    /**
     * Download assignment file
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function assignment(File $file)
    {
        return Storage::download('public/uploads/assignment/' . $file->url, $file->name);
    }
}

<?php
namespace Rap2hpoutre\LaravelLogViewer;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;


class LogViewerController extends Controller
{

    public function index()
    {
        if (Input::get('l')) {
            LaravelLogViewer::setFile(base64_decode(Input::get('l')));
        }

        if (Input::get('dl')) {
            return Response::download(storage_path() . '/logs/' . base64_decode(Input::get('dl')));
        } 

        $logs = LaravelLogViewer::all();

        return View::make('laravel-log-viewer::log', [
            'logs' => $logs,
            'files' => LaravelLogViewer::getFiles(true),
            'current_file' => LaravelLogViewer::getFileName()
        ]);
    }

}

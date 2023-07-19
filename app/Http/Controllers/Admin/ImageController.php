<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    protected array $acceptedTypes = [
        'image/jpeg',
        'image/png',
        'image/gif',
        'image/bmp',
        'image/webp',
        'image/svg+xml',
        'image/tiff',
        'image/x-icon',
    ];

    /**
     * Handle the incoming request.
     */
    public function __invoke($filename)
    {
        $path = storage_path('app/').$filename;

        if (file_exists($path) === false) {
            abort(404);
        }

        $file = file_get_contents($path);
        $type = mime_content_type($path);

        if (in_array($type, $this->acceptedTypes)) {
            return Response::make($file, 200, ['Content-Type' => $type]);
        }

        abort(404);
    }
}

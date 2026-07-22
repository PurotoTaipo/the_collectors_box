<?php

class ImageController extends Controller
{
    /**
     * Serve a cover image: image/cover/[NAME].jpg
     *
     * For now this reads straight from the example covers folder.
     * Later this will resolve the image through the collectable object.
     */
    public function cover(string $name): void
    {
        // basename() strips any path component to prevent traversal.
        $filename = basename($name);
        $path     = COVERS_PATH . '/' . $filename;

        if ($filename === '' || !is_file($path)) {
            http_response_code(404);
            exit('404 Not Found');
        }

        $mime = mime_content_type($path) ?: 'application/octet-stream';

        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($path));
        header('Cache-Control: public, max-age=86400');

        readfile($path);
    }
}

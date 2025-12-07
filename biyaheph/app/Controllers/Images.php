<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;

class Images extends Controller
{
    /**
     * Serve uploaded images from writable/uploads safely.
     *
     * URL: /images/show/{filename}
     */
    public function show(string $filename = null)
    {
        if (empty($filename)) {
            throw PageNotFoundException::forPageNotFound('Image not specified');
        }

        // sanitize filename to prevent directory traversal
        $name = basename($filename);

        // allow only common filename chars (letters, numbers, dash, underscore, dot)
        if (! preg_match('/^[a-zA-Z0-9_\-\.]+$/', $name)) {
            throw PageNotFoundException::forPageNotFound('Invalid image name');
        }

        $path = WRITEPATH . 'uploads' . DIRECTORY_SEPARATOR . $name;

        if (! is_file($path)) {
            // try a public placeholder (optional)
            $placeholder = FCPATH . 'assets/img/placeholder.png';
            if (is_file($placeholder)) {
                $mime = mime_content_type($placeholder) ?: 'image/png';
                return $this->response->setHeader('Content-Type', $mime)
                                      ->setBody(file_get_contents($placeholder));
            }

            throw PageNotFoundException::forPageNotFound('Image not found');
        }

        $mime = mime_content_type($path) ?: 'application/octet-stream';
        return $this->response->setHeader('Content-Type', $mime)
                              ->setBody(file_get_contents($path));
    }
}
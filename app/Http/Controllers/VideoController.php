<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
{
    $majors = [
        'eis' => [
            'name'   => 'EIS',
            'title'  => 'Enterprise Information Systems',
            'videos' => [
                [
                    'url'   => route('videos.stream', ['filename' => 'eis.mp4']),
                    'title' => 'Enterprise Information Systems (EIS) Overview',
                    'type'  => 'video',
                ],
            ],
        ],
        'ai' => [
            'name'   => 'AI',
            'title'  => 'Artificial Intelligence',
            'videos' => [
                [
                    'url'   => route('videos.stream', ['filename' => 'ai-1.mp4']),
                    'title' => 'AI Fundamentals',
                    'type'  => 'video',
                ],
                [
                    'url'   => route('videos.stream', ['filename' => 'ai-2.mp4']),
                    'title' => 'AI Basics',
                    'type'  => 'video',
                ],
                [
                    'url'   => route('videos.stream', ['filename' => 'ai-3.mp4']),
                    'title' => 'AI Application 1',
                    'type'  => 'video',
                ],
                [
                    'url'   => route('videos.stream', ['filename' => 'ai-4.mp4']),
                    'title' => 'AI Application 2',
                    'type'  => 'video',
                ],
                [
                    'url'   => route('videos.stream', ['filename' => 'ai-5.mp4']),
                    'title' => 'AI Future',
                    'type'  => 'video',
                ],
                [
                    'url'   => '/storage/images/ai-image.png',
                    'title' => 'AI Overview',
                    'type'  => 'image',
                ],
            ],
        ],
        'fullstack' => [
            'name'   => 'Full Stack',
            'title'  => 'Full Stack Development',
            'videos' => [
                [
                    'url'   => route('videos.stream', ['filename' => 'fullstack.mp4']),
                    'title' => 'Full Stack Development Overview',
                    'type'  => 'video',
                ],
            ],
        ],
        'cybersecurity' => [
            'name'   => 'Cybersecurity',
            'title'  => 'Cybersecurity',
            'videos' => [
                [
                    'url'   => route('videos.stream', ['filename' => 'cybersecurity.mp4']),
                    'title' => 'Cybersecurity Overview',
                    'type'  => 'video',
                ],
            ],
        ],
        'gamedev' => [
            'name'   => 'Game Developer',
            'title'  => 'Game Development',
            'videos' => [
                [
                    'url'   => route('videos.stream', ['filename' => 'gamedev.mp4']),
                    'title' => 'Game Development Overview',
                    'type'  => 'video',
                ],
            ],
        ],
    ];

    return view('pages.videos', ['majors' => $majors]);
}
    public function stream(Request $request, string $filename)
{
    // Only allow video files for safety
    if (!preg_match('/\.(mp4|webm|ogg)$/i', $filename)) {
        abort(403);
    }

    $path = storage_path('app/public/videos/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    $size     = filesize($path);
    $mimeType = mime_content_type($path) ?: 'video/mp4';

    // No Range header — tell browser we support ranges and return full file
    if (!$request->hasHeader('Range')) {
        return response()->stream(function () use ($path) {
            readfile($path);
        }, 200, [
            'Content-Type'   => $mimeType,
            'Content-Length' => $size,
            'Accept-Ranges'  => 'bytes',
        ]);
    }

    // Parse "bytes=start-end"
    preg_match('/bytes=(\d+)-(\d*)/', $request->header('Range'), $matches);

    $start  = (int) $matches[1];
    $end    = isset($matches[2]) && $matches[2] !== '' ? (int) $matches[2] : $size - 1;
    $end    = min($end, $size - 1);
    $length = $end - $start + 1;

    return response()->stream(function () use ($path, $start, $length) {
        $fp        = fopen($path, 'rb');
        $remaining = $length;

        fseek($fp, $start);

        while (!feof($fp) && $remaining > 0) {
            $chunk      = fread($fp, min(8192, $remaining));
            $remaining -= strlen($chunk);
            echo $chunk;
            flush();
        }

        fclose($fp);
    }, 206, [
        'Content-Type'   => $mimeType,
        'Content-Range'  => "bytes {$start}-{$end}/{$size}",
        'Accept-Ranges'  => 'bytes',
        'Content-Length' => $length,
        'Cache-Control'  => 'no-cache, must-revalidate',
    ]);
}
}

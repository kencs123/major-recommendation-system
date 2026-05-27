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
                'name' => 'EIS',
                'title' => 'Enterprise Information Systems',
                'videos' => [
                    ['url' => '/storage/videos/eis.mp4', 'title' => 'Enterprise Information Systems (EIS) Overview'],
                ],
            ],
            'ai' => [
                'name' => 'AI',
                'title' => 'Artificial Intelligence',
                'videos' => [
                    ['url' => '/storage/videos/ai-1.mp4', 'title' => 'AI Fundamentals'],
                    ['url' => '/storage/videos/ai-2.mp4', 'title' => 'AI Applications'],
                ],
            ],
            'fullstack' => [
                'name' => 'Full Stack',
                'title' => 'Full Stack Development',
                'videos' => [
                    ['url' => '/storage/videos/fullstack.mp4', 'title' => 'Full Stack Development Overview'],
                ],
            ],
            'cybersecurity' => [
                'name' => 'Cybersecurity',
                'title' => 'Cybersecurity',
                'videos' => [
                    ['url' => '/storage/videos/cybersecurity.mp4', 'title' => 'Cybersecurity Overview'],
                ],
            ],
            'gamedev' => [
                'name' => 'Game Developer',
                'title' => 'Game Development',
                'videos' => [
                    ['url' => '/storage/videos/gamedev.mp4', 'title' => 'Game Development Overview'],
                ],
            ],
        ];

        return view('pages.videos', ['majors' => $majors]);
    }
}

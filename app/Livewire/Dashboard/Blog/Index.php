<?php

namespace App\Livewire\Dashboard\Blog;

use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;

class Index extends Component
{
    public $blogs = [];
    public function mount()
    {
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
        // ->withBody(json_encode($body), 'application/json')
        ->get($apiEndpoints::allBlog());
        if ($response->successful()) {
            $this->blogs = $response->json()['data'];
        }
    }
    public function render()
    {
        return view('livewire.dashboard.blog.index');
    }
}

<?php

namespace App\Livewire\Dashboard\Blog;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;

class Show extends Component
{
    public $show;
    public $slug;
    public $userIp;
    public function mount(Request $request, $slug)
    {
        $this->slug = $slug;
        $this->userIp = $request->header('X-Forwarded-For') ?? $request->header('X-Real-IP') ?? $request->ip();
        $this->queryBlog();
      
    }
    public function queryBlog()
    {
        $body = [
            "slug" => $this->slug,
            "userIp" => $this->userIp,
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post($apiEndpoints::showBlog());
        if ($response->successful()) {
            $this->show = $response->json()['data'];
        }
    }
    public function render()
    {
        return view('livewire.dashboard.blog.show');
    }
}

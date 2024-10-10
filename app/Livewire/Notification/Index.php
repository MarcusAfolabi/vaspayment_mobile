<?php

namespace App\Livewire\Notification;

use Carbon\Carbon;
use Livewire\Component;
use App\Services\ApiEndpoints;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class Index extends Component
{
    public $groupedNotifications;
    public $userId;
    public function mount()
    {
        $this->userId = Session::get("user")['id'];
        $this->getNotifications();
    }
    public function getNotifications()
    {
        $body = [
            'user_id' => $this->userId,
        ];
        $apiEndpoints = new ApiEndpoints();
        $headers = $apiEndpoints->header();
        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body), 'application/json')
            ->post(ApiEndpoints::userNotification());
            if ($response->successful()) {
                
                $notifications = $response->json()['data'];
            // Group notifications based on the date
            $this->groupedNotifications = [
                    'today' => [],
                    'yesterday' => [],
                    'others' => []
                ];
                
                foreach ($notifications as $notification) {
                    $createdAt = Carbon::parse($notification['created_at']);
                    $now = Carbon::now();
                    $yesterday = Carbon::yesterday();
                    
                    // Group notifications
                    if ($createdAt->isToday()) {
                        $this->groupedNotifications['today'][] = $notification;
                    } elseif ($createdAt->isYesterday()) {
                        $this->groupedNotifications['yesterday'][] = $notification;
                    } else {
                        // For older dates, you can format as "Fri 01/10/2024"
                        $this->groupedNotifications['others'][] = [
                            'date' => $createdAt->format('D d/m/Y'),
                            'notification' => $notification
                        ];
                    }
                }
                // dd($this->groupedNotifications);
        } else {
            $this->addError('notification', $response->json()['message']);
        }
    }
    public function render()
    {
        return view('livewire.notification.index');
    }
}

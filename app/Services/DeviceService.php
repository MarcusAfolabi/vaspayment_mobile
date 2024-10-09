<?php

namespace App\Services;

use Jenssegers\Agent\Agent;

class DeviceService
{
    public function getDeviceName()
    {
        try {
            $agent = new Agent();
            $isPhone = $agent->isPhone() ? 'Yes' : 'No';
            $isDesktop = $agent->isDesktop() ? 'Yes' : 'No';
            $browser = $agent->browser();
            $browserVersion = $agent->version($browser);
            $os = $agent->platform();
            $OSversion = $agent->version($os);
            return "Is Phone: $isPhone, Is Desktop: $isDesktop, Browser Type: $browser, Browser Version: $browserVersion, OS Type: $os, OS Version: $OSversion";
        } catch (\Throwable $th) {
            info($th->getMessage());
            throw new \Exception('Unable to get your device properties');
        }
    }
}

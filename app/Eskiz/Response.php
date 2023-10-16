<?php

namespace App\Eskiz;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Response
{

    private string $email = 'YOUR_EMAIL';
    private string $password = 'YOUR_PASSWORD';
    private ?string $token = null;

    public function getCode()
    {
        if (! $this->token) {
            $this->token = $this->refreshToken();
        }
        $response = Http::withToken($this->token)
            ->post('notify.eskiz.uz/api/message/sms/send', [
                'mobile_phone' => '998901234567',
                'message' => '1234',
                'from' => '4546'
            ]);
        return $response;

    }
    protected function refreshToken() // update token
    {
        $response = Http::post('notify.eskiz.uz/api/auth/login', [
            'email' => $this->email,
            'password' => $this->password
        ]);
        $token = $response->json('data.token');
        $this->token = $token;
        Cache::put('token', $token);
        return $token;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\WebhookRequest;
use Illuminate\Http\Request;

class HandleRequestsController extends Controller
{
    public function __invoke(Url $url)
    {
        $method = request()->method();
        $headers = request()->headers->all();
        $ip = request()->ip();
        $body = json_encode(request()->all());

        WebhookRequest::create([
            'url_id' => 1,
            'method' => $method,
            'headers' => $headers,
            'ip' => $ip,
            'body' => $body,
        ]);

        return compact('method', 'headers', 'ip', 'body');
    }
}

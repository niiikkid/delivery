<?php

namespace App\API\Dostavista;

use App\API\Dostavista\Exceptions\DostavistaException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http as HttpClient;

class Http
{
    private readonly string $api_host;

    public function __construct(
        private readonly string $token,
    )
    {
        $this->api_host = is_production()
            ? 'https://robot.dostavista.ru/api/business/1.4'
            : 'https://robotapitest.dostavista.ru/api/business/1.4';
    }

    public function request(string $method, string $uri, array $parameters = []): array
    {
        $http = HttpClient::asJson()
            ->withHeaders([
                'X-DV-Auth-Token' => $this->token,
            ]);
        $response = $http->$method($this->api_host . $uri, $parameters);

        return $this->makeResponse($response);
    }

    private function makeResponse(Response $response): array
    {
        if ($response->failed()) {
            throw DostavistaException::make($response->json());
        }

        return $response->json();
    }
}

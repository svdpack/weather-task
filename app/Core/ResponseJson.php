<?php

namespace App\Core;

class ResponseJson
{

    public function success(mixed $data = null, ?int $code = 200, ?string $message = null): void
    {
        $this->createJsonResponse(true, $data, $code, $message);
    }

    public function error(?string $message = null, ?int $code = 400, mixed $data = null): void
    {
        if ($code < 400) {
            $code = 400;
        }

        $this->createJsonResponse(false, $data, $code, $message);
    }

    private function createJsonResponse(bool $isSuccess, mixed $data, ?int $code, ?string $message)
    {
        $result = [
            'status' => $isSuccess,
        ];
        if (!is_null($message)) {
            $result['message'] = $message;
        }
        if (!is_null($data)) {
            $result['data'] = $data;
        }

        http_response_code($code);
        header("Content-type: application/json; charset=utf-8");

        echo json_encode($result);

        exit();
    }
}
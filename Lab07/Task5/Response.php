<?php

class Response {
    private int $statusCode = 200;
    private array $headers = [];

    public function setStatus(int $code): void {
        $this->statusCode = $code;
    }

    public function addHeader(string $header): void {
        $this->headers[] = $header;
    }

    public function send(string $content): void {
        ob_start();
        ob_clean();
        http_response_code($this->statusCode);

        foreach ($this->headers as $header) {
            header($header);
        }
        echo $content;

        ob_end_flush();
    }
}

?>

<?php

declare(strict_types=1);

namespace Brzuchal\TerminalQr;

use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Encoder\Encoder;
use Brzuchal\TerminalQr\Renderer\AnsiRenderer;
use Brzuchal\TerminalQr\Renderer\Renderer;

final class TerminalQrCode
{
    private Renderer $renderer;
    private ErrorCorrectionLevel $errorCorrectionLevel;

    public function __construct(
        Renderer|null $renderer = null,
        ErrorCorrectionLevel|null $errorCorrectionLevel = null,
    ) {
        $this->renderer = $renderer ?? new AnsiRenderer();
        $this->errorCorrectionLevel = $errorCorrectionLevel ?? ErrorCorrectionLevel::L();
    }

    public function render(string $content): string
    {
        $qrCode = Encoder::encode($content, $this->errorCorrectionLevel);

        return $this->renderer->render($qrCode);
    }

    public function write(string $content, mixed $output = STDOUT): void
    {
        $rendered = $this->render($content);
        if (is_resource($output)) {
            fwrite($output, $rendered);
        } elseif (is_string($output) && is_writable($output)) {
            file_put_contents($output, $rendered);
        } else {
             echo $rendered;
        }
    }
}

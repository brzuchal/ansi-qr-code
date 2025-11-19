<?php

declare(strict_types=1);

namespace Brzuchal\TerminalQr\Renderer;

use BaconQrCode\Encoder\QrCode;

interface Renderer
{
    public function render(QrCode $qrCode): string;
}

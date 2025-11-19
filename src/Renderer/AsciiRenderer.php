<?php

declare(strict_types=1);

namespace Brzuchal\TerminalQr\Renderer;

use BaconQrCode\Encoder\QrCode;

final class AsciiRenderer implements Renderer
{
    public function render(QrCode $qrCode): string
    {
        $matrix = $qrCode->getMatrix();
        $width = $matrix->getWidth();
        $height = $matrix->getHeight();

        $output = '';
        $black = '██';
        $white = '  ';

        $margin = 2;

        // Top margin
        for ($i = 0; $i < $margin; $i++) {
            $output .= str_repeat($white, $width + 2 * $margin) . PHP_EOL;
        }

        for ($y = 0; $y < $height; $y++) {
            // Left margin
            $output .= str_repeat($white, $margin);

            for ($x = 0; $x < $width; $x++) {
                $output .= $matrix->get($x, $y) === 1 ? $black : $white;
            }

            // Right margin
            $output .= str_repeat($white, $margin) . PHP_EOL;
        }

        // Bottom margin
        for ($i = 0; $i < $margin; $i++) {
            $output .= str_repeat($white, $width + 2 * $margin) . PHP_EOL;
        }

        return $output;
    }
}

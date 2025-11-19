<?php

declare(strict_types=1);

namespace Brzuchal\TerminalQr\Renderer;

use BaconQrCode\Encoder\QrCode;

final class AnsiRenderer implements Renderer
{
    private const string ESC = "\033";
    private const string RESET = self::ESC . '[0m';
    private const string BLACK_BG = self::ESC . '[40m';
    private const string WHITE_BG = self::ESC . '[47m';
    private const string BLACK_FG = self::ESC . '[30m';
    private const string WHITE_FG = self::ESC . '[37m';

    // Using half-blocks to render two rows at once for better aspect ratio in terminal
    private const string UPPER_HALF_BLOCK = '▀';
    private const string LOWER_HALF_BLOCK = '▄';
    private const string FULL_BLOCK = '█';

    public function render(QrCode $qrCode): string
    {
        $matrix = $qrCode->getMatrix();
        $width = $matrix->getWidth();
        $height = $matrix->getHeight();

        $output = '';

        // Add quiet zone (margin)
        $margin = 2; // 2 modules margin

        // Top margin
        for ($i = 0; $i < $margin; $i += 2) {
            $output .= self::WHITE_BG . self::WHITE_FG .
                str_repeat(self::FULL_BLOCK, $width + 2 * $margin) .
                self::RESET . PHP_EOL;
        }

        for ($y = 0; $y < $height; $y += 2) {
            // Left margin
            $output .= self::WHITE_BG . self::WHITE_FG . str_repeat(self::FULL_BLOCK, $margin) . self::RESET;

            for ($x = 0; $x < $width; $x++) {
                $top = $matrix->get($x, $y) === 1;
                $bottom = $y + 1 < $height ? ($matrix->get($x, $y + 1) === 1) : false;

                if ($top && $bottom) {
                    // Both black
                    $output .= self::BLACK_BG . self::BLACK_FG . self::FULL_BLOCK;
                } elseif ($top) {
                    // Top black, bottom white
                    $output .= self::WHITE_BG . self::BLACK_FG . self::UPPER_HALF_BLOCK;
                } elseif ($bottom) {
                    // Top white, bottom black
                    $output .= self::WHITE_BG . self::BLACK_FG . self::LOWER_HALF_BLOCK;
                } else {
                    // Both white
                    $output .= self::WHITE_BG . self::WHITE_FG . self::FULL_BLOCK;
                }
            }

            // Right margin
            $output .= self::WHITE_BG . self::WHITE_FG .
                str_repeat(self::FULL_BLOCK, $margin) .
                self::RESET . PHP_EOL;
        }

        for ($i = 0; $i < $margin; $i += 2) {
             $output .= self::WHITE_BG . self::WHITE_FG .
                 str_repeat(self::FULL_BLOCK, $width + 2 * $margin) .
                 self::RESET . PHP_EOL;
        }

        return $output;
    }
}

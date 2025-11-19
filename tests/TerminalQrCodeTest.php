<?php

declare(strict_types=1);

namespace Brzuchal\TerminalQr\Tests;

use Brzuchal\TerminalQr\Renderer\AsciiRenderer;
use Brzuchal\TerminalQr\TerminalQrCode;
use PHPUnit\Framework\TestCase;

final class TerminalQrCodeTest extends TestCase
{
    public function testRenderReturnsString(): void
    {
        $qr = new TerminalQrCode();
        $output = $qr->render('https://example.com');

        $this->assertIsString($output);
        $this->assertNotEmpty($output);
    }

    public function testRenderWithAsciiRenderer(): void
    {
        $qr = new TerminalQrCode(new AsciiRenderer());
        $output = $qr->render('https://example.com');

        $this->assertIsString($output);
        $this->assertStringContainsString('██', $output);
    }
}

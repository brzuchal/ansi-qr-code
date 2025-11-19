<?php

require __DIR__ . '/vendor/autoload.php';

use Brzuchal\TerminalQr\TerminalQrCode;

$qr = new TerminalQrCode();
$qr->write('https://github.com/brzuchal/ansi-qr-code');
echo PHP_EOL;

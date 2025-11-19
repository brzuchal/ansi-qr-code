# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.4] - 2025-11-19
### Added
- Added `CHANGELOG.md` project history.

## [1.1.3] - 2025-11-19
### Added
- Automatic renderer detection and fallback to `AsciiRenderer` when output is not TTY or `NO_COLOR` is set.

## [1.1.2] - 2025-11-19
### Changed
- Updated README to clarify that the installer provides the `qr` command.

## [1.1.1] - 2025-11-19
### Fixed
- Updated installer script URL in README to point to the correct branch.

## [1.1.0] - 2025-11-19
### Added
- New CLI tool `qr` for generating QR codes directly from the terminal.
- `bin` entry in `composer.json`.

### Changed
- Suppressed deprecation warnings in CLI tool for PHP 8.4 compatibility.

## [1.0.0] - 2025-11-19
### Added
- Initial release.
- `AnsiRenderer` for high-resolution terminal QR codes using half-block characters.
- `AsciiRenderer` for compatible full-block rendering.
- `TerminalQrCode` main class.
- PHP 8.3+ support.

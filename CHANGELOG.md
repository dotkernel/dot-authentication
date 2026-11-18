# Changelog

## 3.0.0 - TBD

### Changed

- `Dot\Authentication\Exception\ExceptionInterface` extends `Throwable`.
- `AuthenticationResult::setIdentity()` accepts `null` to clear the identity.
- `AuthenticationResult` constants have the type `int`.
- `UnauthorizedException::__construct()` accepts any `Throwable` as `$previous`.
- PHPStan runs at level 8.
- Tests use PHPUnit 12 and a real identity fixture instead of mocks.
- PHPUnit fails on all issues: notices, warnings, deprecations and risky tests.
- The 2.x line gets only security fixes.

### Added

- Support for PHP 8.6.
- Documentation for v3.
- Upgrade guide from 2.x.

### Deprecated

- Nothing

### Removed

- Support for PHP 8.2.

### Fixed

- `InvalidArgumentExceptionTest` tests the package class instead of the SPL class.

## 2.7.0 - 2025-10-31

### Added

- Support for PHP 8.4 and 8.5.

### Removed

- Support for PHP 8.1.

### Fixed

- PHPStan badges.

## 2.6.0 - 2025-03-05

### Changed

- Replaced Psalm with PHPStan.

## 2.5.1 - 2025-01-27

### Changed

- Codecov runs on PHP 8.4.
- Psalm 6.x.

## 2.5.0 - 2025-01-23

### Added

- Support for PHP 8.4.
- `.laminas-ci.json`.

## 2.4.0 - 2024-05-03

### Added

- Documentation for v2.
- More tests.

### Fixed

- Errors in `README.md` and `usage.md`.

## 2.3.4 - 2023-12-04

### Added

- Support for PHP 8.3.

## 2.3.3 - 2023-10-11

### Changed

- Return type of `IdentityInterface::getId()`.

## 2.3.2 - 2023-08-21

### Changed

- Allow `psr/http-message` 2.x.

### Fixed

- Codecov configuration.
- A return type.

## 2.3.1 - 2023-08-17

### Changed

- Type hints and access modifiers.

### Added

- Static analysis badges.

## 2.3.0 - 2023-07-18

### Added

- Unit tests, PHPCS, static analysis and the test GitHub Actions.

### Changed

- Line endings from CRLF to LF.

## 2.2.0 - 2023-03-29

### Removed

- `laminas/laminas-dependency-plugin`.

## 2.1 - 2022-04-26

### Changed

- Prepared `composer.json` and `README.md` for the release.

## 2.0.0 - 2020-01-30

### Changed

- Laminas and Mezzio migration.

### Added

- Nothing

### Deprecated

- Nothing

### Removed

- Support

### Fixed

- Nothing

## 1.0.0 - 2018-04-12

Version bump

### Added

- Update composer.json file

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 0.1.1 - 2017-03-10

### Added

- Updated php file headers doc blocks

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

## 0.1.0 - 2017-03-07

Initial tagged release

### Added

- Everything

### Deprecated

- Nothing

### Removed

- Nothing

### Fixed

- Nothing

# psdiag

PrestaShop (1.5, 1.6, 1.7) diagnostic tool.

## How to use
Copy this file (psdiag.php) to your PrestaShop root directory (where there are index.php, init.php and so on).
Run this script via web browser or from console.

Examples:
1) Run from browser: http://localhost/prestashop/psdiag.php
2) Run from console: php psdiag.php

First of all the PrestaShop diagnose should be done from a web browser because it is the web application.

## Report example
```
Running from web browser.
[ok] : Upload files (it is mandatory)
[ok] : Check recursive write permissions on /cache/
[ok] : Check recursive write permissions on /log/
[ok] : Check recursive write permissions on /img/
[ok] : Check recursive write permissions on /modules/
[ok] : Check recursive write permissions on /themes/default-bootstrap/lang/
[ok] : Check recursive write permissions on /themes/default-bootstrap/pdf/lang/
[ok] : Check recursive write permissions on /themes/default-bootstrap/cache/
[ok] : Check recursive write permissions on /translations/
[ok] : Check recursive write permissions on /upload/
[ok] : Check recursive write permissions on /download/
[ok] : Create new files and folders (it is mandatory)
[ok] : PHP >= 5.2.0 (it is minimal requirement). Recommended PHP >= 5.4.0. Installed: 5.6.3
[ok] : GD library (it is mandatory)
[ok] : MySQL support (it is mandatory)
[ok] : Check recursive write permissions on /config/
[ok] : Check some files of PrestaShop distribution
[ok] : Check recursive write permissions on /mails/
[ok] : Open external URLs (recommended to be enabled)
[ok] : PHP register_globals option (should be disabled)
[ok] : GZIP compression (recommended to be enabled)
[ok] : Mcrypt extension (should be enabled)
[ok] : Mbstring extension (should be enabled)
[ok] : PHP magic quotes option (should be disabled)
[ok] : Dom extension (recommended to be enabled)
[ok] : PDO MySQL extension (recommended to be enabled)
```
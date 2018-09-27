# Diagnostic tool for PrestaShop CMS
Easy to use tool to diagnose PrestaShop. [The tool homepage][5].

## How to use
Copy this file (`psdiag.php`) to your PrestaShop root directory (where there are index.php, init.php and so on).
Run this script via web browser or from console.

Examples:
1) Run from browser: `http://localhost/prestashop/psdiag.php`
2) Run from console: `php psdiag.php`

First of all the PrestaShop diagnose should be done from a web browser because it is the web application.

### Report example
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

## How to help the project grow and get updates
* **Become the [patron][2]** to help me work more for supporting and improving this project.
* Report an issue.
* Give me feedback or [contact with me][3].
* Give the star to the project.
* Contribute to the code.

## Contributing to the code

### Requirements for code contributors 

Contributors **must** follow the following rules:

* **Make your Pull Request on the *dev* branch**, NOT the *master* branch.
* Do not update a helper version number.
* Follow [PSR coding standards][1].

### Process in details for code contributors

Contributors wishing to edit the project's files should follow the following process:

1. Create your GitHub account, if you do not have one already.
2. Fork the project to your GitHub account.
3. Clone your fork to your local machine.
4. Create a branch in your local clone of the project for your changes.
5. Change the files in your branch. Be sure to follow [the coding standards][1].
6. Push your changed branch to your fork in your GitHub account.
7. Create a pull request for your changes **on the *dev* branch** of the project.
   If you need help to make a pull request, read the [Github help page about creating pull requests][4].
8. Wait for the maintainer to apply your changes.

**Do not hesitate to create a pull request if even it's hard for you to apply the coding standards.**

[1]: https://www.php-fig.org/psr/
[2]: https://www.patreon.com/zapalm
[3]: https://prestashop.modulez.ru/en/contact-us
[4]: https://help.github.com/articles/about-pull-requests/
[5]: https://prestashop.modulez.ru/en/tools-scripts/50-prestashop-diagnostic-tool.html
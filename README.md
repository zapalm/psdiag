# Diagnostic tool for PrestaShop CMS
**The library and the tool to diagnose PrestaShop.**

## Information for regular users
The tool home page and the support page: [prestashop.modulez.ru][1].
The full description, how to use and the stable release for download are available there.

## Information for advanced users

### Report example
```
SOFTWARE INFORMATION:
PrestaShop version: 1.7 (1.7.6.8)
PHP version: 5.6 (5.6.38)
ionCube version: 10.3.9
PrestaShop classes override system enabled: Yes
The site has configuration issues: Yes

REQUIREMENTS:
[fail] : Checking PHP compatibility. Minimum but not recommended PHP version: 5.6. Maximum PHP version: 7.2. Your PHP version: 5.6.38.
[fail] : Checking PHP compatibility. Recommended PHP version: 7.1. So that your PrestaShop is compatible with as many modules as possible and works stably.
[ok] : Checking Apache2 configuration. The module "mod_rewrite" must be enabled.
[ok] : Checking PHP configuration. Functions must be enabled: fclose, fread, fwrite, rename, file_exists, unlink, rmdir, mkdir, getcwd, chdir, chmod.
[ok] : Checking PHP configuration. Recommended to install "Zlib" extension.
[ok] : Checking PHP configuration. Recommended to install "ionCube Loader" extension with 10.3.9 version or newer.
[ok] : Checking PHP configuration. The "DOM" extension must be enabled. The example of installation command in Debian/Ubuntu: sudo apt-get install php-xml.
[ok] : Checking PHP configuration. The "JSON" extension must be enabled. The example of installation command in Debian/Ubuntu: sudo apt-get install php-json.
[ok] : Checking PHP configuration. The "SimpleXML" extension must be enabled. The example of installation command in Debian/Ubuntu: sudo apt-get install php-xml.
[ok] : Checking PHP configuration. The "ZIP" extension must be enabled. The example of installation command in Debian/Ubuntu: sudo apt-get install php-zip.
[ok] : Checking PHP configuration. The extension "php_curl" must be enabled.
[ok] : Checking PHP configuration. The extension "php_fileinfo" must be enabled.
[ok] : Checking PHP configuration. The extension "php_gd2" must be enabled.
[ok] : Checking PHP configuration. The extension "php_intl" must be enabled.
[ok] : Checking PHP configuration. The extension "php_mbstring" must be enabled.
[ok] : Checking PHP configuration. The extension "php_openssl" must be enabled.
[ok] : Checking PHP configuration. The extension "php_pdo_mysql" (recommended) or "php_mysqli" must be enabled.
[ok] : Checking PHP configuration. The option "allow_url_fopen" must be "On".
[ok] : Checking PHP configuration. The option "allow_url_include" must be "Off".
[ok] : Checking PHP configuration. The option "file_uploads" must be "On".
[ok] : Checking PHP configuration. The value of these options must be empty: "auto_prepend_file" and "auto_append_file".
[ok] : Checking write permissions (recommended: 0755) for the directory: app/Resources/translations.
[ok] : Checking write permissions (recommended: 0755) for the directory: app/config.
[ok] : Checking write permissions (recommended: 0755) for the directory: cache.
[ok] : Checking write permissions (recommended: 0755) for the directory: config.
[ok] : Checking write permissions (recommended: 0755) for the directory: download.
[ok] : Checking write permissions (recommended: 0755) for the directory: img.
[ok] : Checking write permissions (recommended: 0755) for the directory: log.
[ok] : Checking write permissions (recommended: 0755) for the directory: mails.
[ok] : Checking write permissions (recommended: 0755) for the directory: modules.
[ok] : Checking write permissions (recommended: 0755) for the directory: themes/classic/cache.
[ok] : Checking write permissions (recommended: 0755) for the directory: themes/classic/lang.
[ok] : Checking write permissions (recommended: 0755) for the directory: themes/classic/pdf/lang.
[ok] : Checking write permissions (recommended: 0755) for the directory: translations.
[ok] : Checking write permissions (recommended: 0755) for the directory: upload.
```

### One-time diagnosis
Copy the folder `psdiag` to your PrestaShop root directory (where there are `index.php`, `init.php` and so on).
Run this script via web browser or from console, for example:
1) Run from browser: `http://localhost/psdiag/index.php`
2) Run from console: `php index.php`

First of all the PrestaShop diagnosis should be done from a web browser because PrestaShop is the web application.

### Installation to your project
Add the dependency directly to your `composer.json` file:
```
"repositories": [
  {
    "type": "vcs",
    "url": "https://github.com/zapalm/psdiag"
  }
],
"require": {
  "php": ">=5.2",
  "zapalm/psdiag": "dev-master"
},
```
See usage example in `index.php` script.

### How to help the project grow and get updates
Give the **star** to the project. That's all! :)

### Contributing to the code

#### Requirements for code contributors 

Contributors **must** follow the following rules:

* **Make your Pull Request on the *dev* branch**, NOT the *master* branch.
* Do not update a helper version number.
* Follow [PSR coding standards][2].

#### Process in details for code contributors

Contributors wishing to edit the project's files should follow the following process:

1. Create your GitHub account, if you do not have one already.
2. Fork the project to your GitHub account.
3. Clone your fork to your local machine.
4. Create a branch in your local clone of the project for your changes.
5. Change the files in your branch. Be sure to follow [the coding standards][2].
6. Push your changed branch to your fork in your GitHub account.
7. Create a pull request for your changes **on the *dev* branch** of the project.
   If you need help to make a pull request, read the [Github help page about creating pull requests][3].
8. Wait for the maintainer to apply your changes.

**Do not hesitate to create a pull request if even it's hard for you to apply the coding standards.**

[1]: https://prestashop.modulez.ru/en/tools-scripts/50-prestashop-diagnostic-tool.html
[2]: https://www.php-fig.org/psr/
[3]: https://help.github.com/articles/about-pull-requests/

<?php
/**
 * PrestaShop diagnostic tool.
 *
 * @author    Maksim T. <zapalm@yandex.com>
 * @copyright 2018 Maksim T.
 * @license   Open Software License (OSL 3.0)
 * @link      https://github.com/zapalm/psdiag GitHub
 * @link      https://prestashop.modulez.ru/en/tools-scripts/50-prestashop-diagnostic-tool.html Homepage
 */

namespace zapalm;

use Configuration;
use ConfigurationTest;

/**
 * PrestaShop diagnostic tool.
 *
 * @version 2.0.0
 *
 * @author Maksim T. <zapalm@yandex.com>
 */
class PsDiag extends ConfigurationTest
{
    /** @var bool Running from console. */
    protected $console;

    /** @var string[] PHP compatibility data with a running version of PrestaShop. */
    protected static $phpCompatibility;

    /**
     * PsDiag constructor.
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public function __construct()
    {
        $this->console            = ('cli' === php_sapi_name());
        static::$phpCompatibility = static::getPhpCompatibility();
    }

    /**
     * Returns PHP compatibility data with a running version of PrestaShop.
     *
     * @return string[]
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public static function getPhpCompatibility()
    {
        $phpCompatibilityDatasheet = [
            '1.5.0' => ['Minimum' => '5.2', 'Recommended' => '5.6', 'Maximum' => '5.6'],
            '1.6.0' => ['Minimum' => '5.2', 'Recommended' => '5.6', 'Maximum' => '5.6'],
            '1.7.0' => ['Minimum' => '5.4', 'Recommended' => '7.1', 'Maximum' => '7.1'],
            '1.7.1' => ['Minimum' => '5.4', 'Recommended' => '7.1', 'Maximum' => '7.1'],
            '1.7.2' => ['Minimum' => '5.4', 'Recommended' => '7.1', 'Maximum' => '7.1'],
            '1.7.3' => ['Minimum' => '5.4', 'Recommended' => '7.1', 'Maximum' => '7.1'],
            '1.7.4' => ['Minimum' => '5.6', 'Recommended' => '7.1', 'Maximum' => '7.1'],
            '1.7.5' => ['Minimum' => '5.6', 'Recommended' => '7.1', 'Maximum' => '7.2'],
            '1.7.6' => ['Minimum' => '5.6', 'Recommended' => '7.1', 'Maximum' => '7.2'],
            '1.7.7' => ['Minimum' => '7.1', 'Recommended' => '7.1', 'Maximum' => '7.3'],
            '1.7.8' => ['Minimum' => '7.1', 'Recommended' => '7.1', 'Maximum' => '7.4'],
        ];

        list($branch, $major, $minor) = explode('.', _PS_VERSION_);
        $psVersion = implode('.', [$branch, $major, $minor]);

        if (false === array_key_exists($psVersion, $phpCompatibilityDatasheet)) {
            $psVersion = implode('.', [$branch, $major, 0]);

            if (false === array_key_exists($psVersion, $phpCompatibilityDatasheet)) {
                end($phpCompatibilityDatasheet);
                $psVersion = key($phpCompatibilityDatasheet);
            }
        }

        return $phpCompatibilityDatasheet[$psVersion];
    }

    /**
     * Returns the diagnosis result.
     *
     * @return array The diagnosis result.
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public function diagnose()
    {
        $possibleTests = array_merge(
            static::getDefaultTests(),
            static::getDefaultTestsOp(),
            [    // New tests
                'allow_url_include' => false,
                'ioncube_version'   => false,
                'auto_include_file' => false,
            ]
        );

        unset($possibleTests['mysql_support']); // See improved "pdo_mysql" test
        unset($possibleTests['files']);         // The useless test

        $testsDescriptions = [
            'new_phpversion'                => implode('. ', [
                'Checking PHP compatibility',
                'Minimum but not recommended PHP version: ' . static::$phpCompatibility['Minimum'],
                'Maximum PHP version: ' . static::$phpCompatibility['Maximum'],
                'Your PHP version: ' . phpversion(),
            ]),
            'phpversion'                    => implode('. ', [
                'Checking PHP compatibility',
                'Recommended PHP version: ' . static::$phpCompatibility['Recommended'],
                'So that your PrestaShop is compatible with as many modules as possible and works stably',
            ]),
            'upload'                        => 'Checking PHP configuration. The option "file_uploads" must be "On"',
            'fopen'                         => 'Checking PHP configuration. The option "allow_url_fopen" must be "On"',
            'allow_url_include'             => 'Checking PHP configuration. The option "allow_url_include" must be "Off"',
            'auto_include_file'             => 'Checking PHP configuration. The value of these options must be empty: "auto_prepend_file" and "auto_append_file" (for security reasons and for the operation of some modules)',
            'register_globals'              => 'Checking PHP configuration. The option "register_globals" must be "Off"',
            'magicquotes'                   => 'Checking PHP configuration. These options must be "Off": "magic_quotes_gpc", "magic_quotes_runtime", "magic_quotes_sybase"',
            'system'                        => 'Checking PHP configuration. Functions must be enabled: fclose, fread, fwrite, rename, file_exists, unlink, rmdir, mkdir, getcwd, chdir, chmod',
            'zip'                           => 'Checking PHP configuration. The "ZIP" extension must be enabled. The example of installation command in Debian/Ubuntu: sudo apt-get install php-zip',
            'dom'                           => 'Checking PHP configuration. The "DOM" extension must be enabled. The example of installation command in Debian/Ubuntu: sudo apt-get install php-xml',
            'simplexml'                     => 'Checking PHP configuration. The "SimpleXML" extension must be enabled. The example of installation command in Debian/Ubuntu: sudo apt-get install php-xml',
            'json'                          => 'Checking PHP configuration. The "JSON" extension must be enabled. The example of installation command in Debian/Ubuntu: sudo apt-get install php-json',
            'gd'                            => 'Checking PHP configuration. The extension "php_gd2" must be enabled',
            'pdo_mysql'                     => 'Checking PHP configuration. The extension "php_pdo_mysql" (recommended) or "php_mysqli" must be enabled',
            'mbstring'                      => 'Checking PHP configuration. The extension "php_mbstring" must be enabled',
            'mcrypt'                        => 'Checking PHP configuration. The extension "php_mcrypt" must be enabled',
            'openssl'                       => 'Checking PHP configuration. The extension "php_openssl" must be enabled',
            'curl'                          => 'Checking PHP configuration. The extension "php_curl" must be enabled',
            'fileinfo'                      => 'Checking PHP configuration. The extension "php_fileinfo" must be enabled',
            'intl'                          => 'Checking PHP configuration. The extension "php_intl" must be enabled',
            'gz'                            => 'Checking PHP configuration. Recommended to install "Zlib" extension',
            'ioncube_version'               => 'Checking PHP configuration. Recommended to install "ionCube Loader" extension with 10.3.9 version or newer',
            'config_sf2_dir'                => 'Checking write permissions (recommended: 0755) for the directory: app/config',
            'translations_sf2'              => 'Checking write permissions (recommended: 0755) for the directory: app/Resources/translations',
            'config_dir'                    => 'Checking write permissions (recommended: 0755) for the directory: config',
            'cache_dir'                     => 'Checking write permissions (recommended: 0755) for the directory: cache',
            'log_dir'                       => 'Checking write permissions (recommended: 0755) for the directory: log',
            'img_dir'                       => 'Checking write permissions (recommended: 0755) for the directory: img',
            'mails_dir'                     => 'Checking write permissions (recommended: 0755) for the directory: mails',
            'module_dir'                    => 'Checking write permissions (recommended: 0755) for the directory: modules',
            'theme_lang_dir'                => 'Checking write permissions (recommended: 0755) for the directory: themes/' . _THEME_NAME_ . '/lang',
            'theme_pdf_lang_dir'            => 'Checking write permissions (recommended: 0755) for the directory: themes/' . _THEME_NAME_ . '/pdf/lang',
            'theme_cache_dir'               => 'Checking write permissions (recommended: 0755) for the directory: themes/' . _THEME_NAME_ . '/cache',
            'translations_dir'              => 'Checking write permissions (recommended: 0755) for the directory: translations',
            'customizable_products_dir'     => 'Checking write permissions (recommended: 0755) for the directory: upload',
            'virtual_products_dir'          => 'Checking write permissions (recommended: 0755) for the directory: download',
            'apache_mod_rewrite'            => 'Checking Apache2 configuration. The module "mod_rewrite" must be enabled',
        ];

        $testsResult = static::check($possibleTests);

        $report = [];
        foreach ($testsResult as $testId => $testResult) {
            if (array_key_exists($testId, $testsDescriptions)) {
                $description = $testsDescriptions[$testId];
            } else {
                $description = $testId;
            }

            $report[$testId] = [$testResult, $description . '.'];
        }

        asort($report);

        return $report;
    }

    /**
     * @inheritDoc
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public static function test_new_phpversion()
    {
        return (version_compare(phpversion(), static::$phpCompatibility['Recommended'] . '.0', '>=')
            && version_compare(phpversion(), static::$phpCompatibility['Maximum'] . '.99', '<=')
        );
    }

    /**
     * Test: Running PHP version must be in a recommended range.
     *
     * @return bool True if the test passed.
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public static function test_phpversion()
    {
        return (version_compare(phpversion(), static::$phpCompatibility['Recommended'] . '.0', '>=')
            && version_compare(phpversion(), static::$phpCompatibility['Recommended'] . '.99', '<=')
        );
    }

    /**
     * @inheritDoc
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public static function test_pdo_mysql()
    {
        if (extension_loaded('pdo_mysql')) {
            return true;
        }

        if (version_compare(_PS_VERSION_, '1.7.0.0', '<')) {
            return extension_loaded('mysqli');
        }

        return false;
    }

    /**
     * Test: PHP option "allow_url_include" must be disabled.
     *
     * @return bool True if the test passed.
     *
     * @noinspection PhpUnused
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public static function test_allow_url_include()
    {
        $value = strtolower((string)ini_get('allow_url_include'));

        return ('' === $value
            || false === in_array($value, ['on', '1'])
        );
    }

    /**
     * Test: PHP options "auto_prepend_file" and "auto_append_file" must be disabled.
     *
     * @return bool True if the test passed.
     *
     * @noinspection PhpUnused
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public static function test_auto_include_file()
    {
        return ('' === ini_get('auto_prepend_file') && '' === ini_get('auto_append_file'));
    }

    /**
     * Test: "ionCube" PHP extension version must be 10.3.9 or newer.
     *
     * @return bool True if the test passed.
     *
     * @noinspection PhpUnused
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public static function test_ioncube_version()
    {
        return (function_exists('ioncube_loader_iversion')
            && (int)ioncube_loader_iversion() >= 100309
        );
    }

    /**
     * @inheritDoc
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public static function check($tests)
    {
        $result = [];

        foreach ($tests as $key => $test) {
            $result[$key] = static::run($key, $test);
        }

        return $result;
    }

    /**
     * @inheritDoc
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public static function run($ptr, $arg = 0)
    {
        if (call_user_func([get_called_class(), 'test_' . $ptr], $arg)) {
            return 'ok';
        }

        return 'fail';
    }

    /**
     * Returns IonCube Loader version.
     *
     * @return string|bool
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public static function getIonCubeVersion()
    {
        if (function_exists('ioncube_loader_iversion')) {
            $version = ioncube_loader_iversion();

            return sprintf(
                '%d.%d.%d',
                $version / 10000,
                ($version / 100) % 100,
                $version % 100
            );
        }

        return false;
    }

    /**
     * Returns software information.
     *
     * @return string[]
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public function getSoftwareInfo()
    {
        return [
            'PrestaShop version' => (float)_PS_VERSION_ . ' (' . _PS_VERSION_ . ')',
            'PHP version'        => (float)phpversion() . ' (' . phpversion() . ')',
            'ionCube version'    => (false !== static::getIonCubeVersion()
                ? static::getIonCubeVersion()
                : 'ionCube not enabled'
            ),
            'PrestaShop classes override system enabled' => (Configuration::get('PS_DISABLE_OVERRIDES') ? 'No' : 'Yes'),
        ];
    }

    /**
     * Prints a given report to a browser or to a console.
     *
     * @param array $report The report given by diagnose().
     *
     * @see diagnose()
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public function printReport(array $report)
    {
        $message = 'SOFTWARE INFORMATION:' . PHP_EOL;
        foreach (static::getSoftwareInfo() as $infoKey => $infoValue) {
            $message .= $infoKey . ': ' . $infoValue . PHP_EOL;
        }

        $message .= PHP_EOL . 'REQUIREMENTS:' . PHP_EOL;
        foreach ($report as $testResult) {
            $message .= '[' . $testResult[0] . '] : ' . $testResult[1] . PHP_EOL;
        }

        if (false === $this->console) {
            $message = nl2br($message);
        }

        echo $message;
    }
}
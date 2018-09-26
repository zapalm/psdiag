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

$configPath = dirname(__FILE__) . '/config/config.inc.php';
if (false === file_exists($configPath)) {
    exit('The file of the tool is placed incorrectly. You should place the file to the root of your PrestaShop installation directory.' . PHP_EOL);
}

require_once $configPath;

/**
 * PrestaShop diagnostic tool.
 *
 * @version 1.0.0
 *
 * @author Maksim T. <zapalm@yandex.com>
 */
class PsDiag extends ConfigurationTestCore {

    /** @var bool Running from console */
    protected $console;

    /**
     * PsDiag constructor.
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public function __construct() {
        $this->console = ('cli' === php_sapi_name());
    }

    /**
     * Returns the diagnose result.
     *
     * @return array The diagnose result.
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public function diagnose() {
        $possibleTests = array_merge(self::getDefaultTests(), self::getDefaultTestsOp());

        $neededTests = array(
            'phpversion'                    => 'PHP >= 5.2.0 (it is minimal requirement). Recommended PHP >= 5.4.0. Installed: ' . phpversion(),
            'upload'                        => 'Upload files (it is mandatory)',
            'system'                        => 'Create new files and folders (it is mandatory)',
            'gd'                            => 'GD library (it is mandatory)',
            'mysql_support'                 => 'MySQL support (it is mandatory)',
            'files'                         => 'Check some files of PrestaShop distribution',
            'config_dir'                    => 'Check recursive write permissions on /config/',
            'cache_dir'                     => 'Check recursive write permissions on /cache/',
            'log_dir'                       => 'Check recursive write permissions on /log/',
            'img_dir'                       => 'Check recursive write permissions on /img/',
            'mails_dir'                     => 'Check recursive write permissions on /mails/',
            'module_dir'                    => 'Check recursive write permissions on /modules/',
            'theme_lang_dir'                => 'Check recursive write permissions on /themes/default-bootstrap/lang/',
            'theme_pdf_lang_dir'            => 'Check recursive write permissions on /themes/default-bootstrap/pdf/lang/',
            'theme_cache_dir'               => 'Check recursive write permissions on /themes/default-bootstrap/cache/',
            'translations_dir'              => 'Check recursive write permissions on /translations/',
            'customizable_products_dir'     => 'Check recursive write permissions on /upload/',
            'virtual_products_dir'          => 'Check recursive write permissions on /download/',
            'fopen'                         => 'Open external URLs (recommended to be enabled)',
            'register_globals'              => 'PHP register_globals option (should be disabled)',
            'gz'                            => 'GZIP compression (recommended to be enabled)',
            'mcrypt'                        => 'Mcrypt extension (should be enabled)',
            'mbstring'                      => 'Mbstring extension (should be enabled)',
            'magicquotes'                   => 'PHP magic quotes option (should be disabled)',
            'dom'                           => 'Dom extension (recommended to be enabled)',
            'pdo_mysql'                     => 'PDO MySQL extension (recommended to be enabled)',
        );

        $testsResult = self::check(array_intersect_key($possibleTests, $neededTests));

        $report = array();
        foreach ($testsResult as $testId => $testResult) {
            $report[$testId] = array($testResult, $neededTests[$testId]);
        }

        return $report;
    }

    /**
     * Prints a given report to a browser or to a console.
     *
     * @param array $report The report given by diagnose().
     *
     * @author Maksim T. <zapalm@yandex.com>
     */
    public function printReport(array $report) {
        $message = 'Running from ' . ($this->console ? 'console' : 'web browser') . '.' . PHP_EOL;

        foreach ($report as $testId => $testResult) {
            $message .= '[' . $testResult[0] . '] : ' . $testResult[1] . PHP_EOL;
        }

        if (!$this->console) {
            $message = nl2br($message);
        }

        echo $message;
    }
}

$psDiag = new PsDiag();
$report = $psDiag->diagnose();
$psDiag->printReport($report);

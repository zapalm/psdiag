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

$configPath = __DIR__ . '/../config/config.inc.php';
if (false === file_exists($configPath)) {
    exit('The directory of the tool is placed incorrectly. You should place the directory of the tool to the root of your PrestaShop installation directory.' . PHP_EOL);
}

require_once $configPath;
require_once __DIR__ . '/vendor/autoload.php';

$psDiag = new \zapalm\PsDiag();
$report = $psDiag->diagnose();
$psDiag->printReport($report);

<?php
/**
 * This file is part of Swoft.
 *
 * @link     https://swoft.org
 * @document https://doc.swoft.org
 * @contact  group@swoft.org
 * @license  https://github.com/swoft-cloud/swoft/blob/master/LICENSE
 */

$root = alias('@root');

return [
    'version' => '1.0',
    'autoInitBean' => true,
    'beanScan' => [
        'SwoftTest\\Db\\Testing' => BASE_PATH . '/Testing',
        'Xin\\Swoft\\Db\\Entity' => $root . '/../src/Entity',
    ],
    'I18n' => [
        'sourceLanguage' => '@root/resources/messages/',
    ],
    'env' => 'Base',
    'user.stelin.steln' => 'fafafa',
    'Service' => [
        'user' => [
            'timeout' => 3000
        ]
    ],
    'db' => require dirname(__FILE__) . DS . 'db.php',
];

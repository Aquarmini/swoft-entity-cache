<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <limingxin@swoft.org>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Swoftx\Db\Entity\Operator;

interface OperatorInterface
{
    public function getScript(): string;

    public function parseResponse($data);
}

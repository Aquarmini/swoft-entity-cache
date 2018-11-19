<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <limingxin@swoft.org>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Swoftx\Db\Entity\Operator\Hashs;

use Swoftx\Db\Entity\Operator\OperatorInterface;

class HashsGetMultiple implements OperatorInterface
{
    public function getScript(): string
    {
        $command = <<<LUA
    local values = {}; 
    for i,v in ipairs(KEYS) do 
        if(redis.call('type',v).ok == 'hash') then
            values[#values+1] = redis.call('hgetall',v);
        end
    end
    return values;
LUA;

        return $command;
    }

    public function parseResponse($data)
    {
        $result = [];
        foreach ($data ?? [] as $item) {
            if (!empty($item) && is_array($item)) {
                $temp = [];
                $count = count($item);
                for ($i = 0; $i < $count; ++$i) {
                    $temp[$item[$i]] = $item[++$i];
                }

                $result[] = $temp;
            }
        }

        return $result;
    }
}

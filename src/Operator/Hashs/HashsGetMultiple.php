<?php
namespace Swoftx\Db\Entity\Operator\Hashs;

use Swoftx\Db\Entity\Operator\OperatorInterface;

class HashsGetMultiple implements OperatorInterface
{
    public function getScript(): string
    {
        $command = <<<LUA
    local values = {}; 
    for i,v in ipairs(KEYS) do 
        if(redis.pcall('type',v).ok == 'hash') then
            values[#values+1] = redis.pcall('hgetall',v);
        end
    end 
    return values;
LUA;

//         $command = <<<LUA
//     local result=0;
//     if redis.pcall('type','xx').ok == 'hash' then
//         result = 1;
//     end
//     return result;
// LUA;

        return $command;
    }

    public function parseResponse($data)
    {
        $result = [];
        foreach ($data as $item) {
            if (!empty($item)) {
                $temp = [];
                for ($i = 0; $i < count($item); ++$i) {
                    $temp[$item[$i]] = $item[++$i];
                }

                $result[] = $temp;
            }
        }

        return $result;
    }
}

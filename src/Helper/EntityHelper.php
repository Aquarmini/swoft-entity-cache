<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <limingxin@swoft.org>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace Swoftx\Db\Entity\Helper;

use Swoft\Db\Bean\Collector\EntityCollector;
use Swoft\Db\Exception\DbException;
use Swoft\Helper\ArrayHelper;
use Swoft\Helper\StringHelper;
use Swoft\Db\Helper\EntityHelper as SwoftEntityHelper;

class EntityHelper
{
    /**
     * @param array  $data
     * @param string $className
     *
     * @return object
     */
    public static function arrayToEntity(array $data, string $className)
    {
        $attrs = [];
        $object = new $className();
        $entities = EntityCollector::getCollector();
        if (!isset($entities[$className])) {
            throw new DbException("EntityCollector 中不存在当前实体[{$className}]");
        }

        $entity = $entities[$className];
        foreach ($entity['column'] as $col => $field) {
            $setterMethod = StringHelper::camel('set_' . $field);

            $type = $entity['field'][$field]['type'];
            $value = ArrayHelper::get($data, $field, $entity['field'][$field]['default']);
            $value = SwoftEntityHelper::trasferTypes($type, $value);

            if (\method_exists($object, $setterMethod)) {
                $attrs[$field] = $value;
                if ($value !== null) {
                    $object->$setterMethod($value);
                }
            }
        }
        if (\method_exists($object, 'setAttrs')) {
            $object->setAttrs($attrs);
        }

        return $object;
    }
}

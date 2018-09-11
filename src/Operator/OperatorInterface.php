<?php
namespace Swoftx\Db\Entity\Operator;

interface OperatorInterface
{
    public function getScript(): string;

    public function parseResponse($data);
}
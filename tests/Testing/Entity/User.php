<?php
/**
 * Swoft Entity Cache
 *
 * @author   limx <limingxin@swoft.org>
 * @link     https://github.com/limingxinleo/swoft-entity-cache
 */
namespace SwoftTest\Db\Testing\Entity;

use Swoftx\Db\Entity\ModelCache;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Required;
use Swoft\Db\Bean\Annotation\Table;

/**
 * 用户表
 * @Entity()
 * @Table(name="user")
 * @uses      User
 */
class User extends ModelCache
{
    /**
     * @var int $id
     * @Id()
     * @Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string $name 姓名
     * @Column(name="name", type="string", length=255, default="")
     */
    private $name;

    /**
     * @var int $roleId 角色ID
     * @Column(name="role_id", type="integer")
     * @Required()
     */
    private $roleId;

    /**
     * @var string $createdAt
     * @Column(name="created_at", type="datetime", default="CURRENT_TIMESTAMP")
     */
    private $createdAt;

    /**
     * @var string $updatedAt
     * @Column(name="updated_at", type="datetime", default="CURRENT_TIMESTAMP")
     */
    private $updatedAt;

    /**
     * @param int $value
     * @return $this
     */
    public function setId(int $value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * 姓名
     * @param string $value
     * @return $this
     */
    public function setName(string $value): self
    {
        $this->name = $value;

        return $this;
    }

    /**
     * 角色ID
     * @param int $value
     * @return $this
     */
    public function setRoleId(int $value): self
    {
        $this->roleId = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCreatedAt(string $value): self
    {
        $this->createdAt = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setUpdatedAt(string $value): self
    {
        $this->updatedAt = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 姓名
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 角色ID
     * @return int
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

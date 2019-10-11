<?php

namespace App\Model\Logic\Permission\Role;

use App\Common\Concern\BeanStaticInstance;
use App\Common\Constants\Permission;
use App\Exception\AlreadyExistsException;
use App\Exception\NotFoundException;
use App\Exception\UnauthorizedException;
use App\Model\Dao\Role\RoleDaoInterface;
use App\Model\Entity\Permission\RoleEntity;
use App\Model\Vo\Permission\Role;
use App\Model\Vo\Permission\RolePageSearcher;
use Happysir\Lib\Enum\BoolEnum;
use Happysir\Respository\Concern\Paginator;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * Class RoleLogic
 *
 * @Bean(scope=Bean::PROTOTYPE)
 */
class RoleLogic
{
    use BeanStaticInstance;
    
    /**
     * @Inject(RoleDao::class)
     *
     * @var RoleDaoInterface
     */
    protected $roleDao;
    
    /**
     * 分页筛选查询
     *
     * @param \App\Model\Vo\Permission\RolePageSearcher $searchDto
     * @return \Happysir\Respository\Concern\Paginator
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function filterPagination(RolePageSearcher $searchDto) : Paginator
    {
        return $this->roleDao->filterPagination($searchDto);
    }
    
    /**
     * 创建管理角色
     *
     * @param \App\Model\Vo\Permission\Role $request
     * @return \App\Model\Entity\Permission\RoleEntity
     * @throws \App\Exception\AlreadyExistsException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function initRole(Role $request) : RoleEntity
    {
        $entity = $this->roleDao->getRoleByName($request->getRoleName());
        if ($entity) {
            throw new AlreadyExistsException('角色已存在');
        }
        
        /** @var RoleEntity $entity */
        $entity = RoleEntity::new(['role_name' => $request->getRoleName()]);
        $entity->setRoleDescribe($request->getDescribe());
        
        /** @var RoleEntity $entity */
        $entity = $this->roleDao->createBy($entity);
        
        return $entity;
    }
    
    /**
     * 更新角色
     *
     * @param int                           $id
     * @param \App\Model\Vo\Permission\Role $request
     * @return \App\Model\Entity\Permission\RoleEntity
     * @throws \App\Exception\NotFoundException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function updateRole(int $id, Role $request) : RoleEntity
    {
        $entity = $this->findOrFail($id);
        
        $entity->setRoleName($request->getRoleName());
        $entity->setRoleDescribe($request->getDescribe());
        
        /** @var RoleEntity $entity */
        $entity = $this->roleDao->save($entity);
        
        return $entity;
    }
    
    /**
     * 删除管理角色
     *
     * @param int $id
     * @return bool
     * @throws \App\Exception\NotFoundException
     * @throws \App\Exception\UnauthorizedException
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     */
    public function deleteRole(int $id) : bool
    {
        if ($id === Permission::SUPER_MANAGER_ROLE) {
            throw new UnauthorizedException('请勿删除角色【超级管理员】');
        }
        
        $entity = $this->findOrFail($id);
        
        $entity->setIsDeleted(BoolEnum::TRUE);
        $this->roleDao->save($entity);
        
        return true;
    }
    
    /**
     * 获取角色，角色不存在时抛出异常
     *
     * @param int $id
     * @return \App\Model\Entity\Permission\RoleEntity
     * @throws \ReflectionException
     * @throws \Swoft\Bean\Exception\ContainerException
     * @throws \Swoft\Db\Exception\DbException
     * @throws \App\Exception\NotFoundException
     */
    public function findOrFail(int $id) : RoleEntity
    {
        /** @var RoleEntity $entity */
        $entity = $this->roleDao->find($id);
        if ($entity === null) {
            throw new NotFoundException('角色不存在');
        }
        
        return $entity;
    }
    
    /**
     * 提供指定的角色id，获取其中启用的角色（过滤失效角色id）
     *
     * @param int[] $roleIds
     * @return int[]
     * @throws \ReflectionException
     */
    public function getEnableRoleByRoleIds(array $roleIds) : array
    {
        return $this->roleDao->getEnableRoleByRoleIds($roleIds);
    }
}

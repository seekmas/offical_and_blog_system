<?php

namespace Gemba\AdminBundle\Decorator;

class Repository
{
    private $entity_repository;

    private $limit;

    public function __construct($entity_repository)
    {
        $this->entity_repository = $entity_repository;
        $this->limit = 10;
    }



    public function findAllOrderById()
    {
        return $this->entity_repository
             ->createQueryBuilder('entity')
             ->select('entity')
             ->orderBy('entity.id' , 'desc')
             ->setFirstResult(0)
             ->setMaxResults($this->getLimit())
             ->getQuery()
             ->getResult();
    }

    public function findAllOrderBy($field , $asc = 'asc')
    {
        return $this->entity_repository
                     ->createQueryBuilder('entity')
                     ->select('entity')
                     ->orderBy('entity.'.$field , $asc)
                     ->setFirstResult(0)
                     ->setMaxResults($this->getLimit())
                     ->getQuery()
                     ->getResult();
    }

    public function findAllBy($arrays = [])
    {
        $query = $this->entity_repository
                      ->createQueryBuilder('entity')
                      ->select('entity');

        $flag = true;
        foreach ($arrays as $key => $value) {

            if($flag == true)
            {
                $query->where('entity.'.$key . ' = ' . $value);
            }else
            {
                $query->AndWhere('entity.'.$key . ' = ' . $value);
            }

            if($flag)
            {
                $flag = false;
            }
        }

        return $query->getQuery()->getResult();


    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @return Repository
     * @param mixed $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

    public function __call($name, $arguments)
    {
        if(!method_exists( $this , $name))
        {
            return call_user_func_array( array($this->entity_repository, $name), $arguments );
        }
    }
}

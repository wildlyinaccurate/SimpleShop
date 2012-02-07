<?php

namespace Proxies;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class EntityCategoryProxy extends \Entity\Category implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }
    
    
    public function setDescription($description)
    {
        $this->__load();
        return parent::setDescription($description);
    }

    public function getDescription()
    {
        $this->__load();
        return parent::getDescription();
    }

    public function getId()
    {
        $this->__load();
        return parent::getId();
    }

    public function setImageId($image_id)
    {
        $this->__load();
        return parent::setImageId($image_id);
    }

    public function getImageId()
    {
        $this->__load();
        return parent::getImageId();
    }

    public function addProduct(\Entity\Product $product)
    {
        $this->__load();
        return parent::addProduct($product);
    }

    public function getProducts()
    {
        $this->__load();
        return parent::getProducts();
    }

    public function setSlug($slug)
    {
        $this->__load();
        return parent::setSlug($slug);
    }

    public function getSlug()
    {
        $this->__load();
        return parent::getSlug();
    }

    public function setTitle($title)
    {
        $this->__load();
        return parent::setTitle($title);
    }

    public function getTitle()
    {
        $this->__load();
        return parent::getTitle();
    }

    public function getChildCategories()
    {
        $this->__load();
        return parent::getChildCategories();
    }

    public function setParentCategory($parent_category)
    {
        $this->__load();
        return parent::setParentCategory($parent_category);
    }

    public function getParentCategory()
    {
        $this->__load();
        return parent::getParentCategory();
    }

    public function __toString()
    {
        $this->__load();
        return parent::__toString();
    }

    public function getLeftValue()
    {
        $this->__load();
        return parent::getLeftValue();
    }

    public function setLeftValue($lft)
    {
        $this->__load();
        return parent::setLeftValue($lft);
    }

    public function getRightValue()
    {
        $this->__load();
        return parent::getRightValue();
    }

    public function setRightValue($rgt)
    {
        $this->__load();
        return parent::setRightValue($rgt);
    }

    public function getRootValue()
    {
        $this->__load();
        return parent::getRootValue();
    }

    public function setRootValue($root)
    {
        $this->__load();
        return parent::setRootValue($root);
    }

    public function setCreatedDate()
    {
        $this->__load();
        return parent::setCreatedDate();
    }

    public function getCreatedDate()
    {
        $this->__load();
        return parent::getCreatedDate();
    }

    public function setModifiedDate()
    {
        $this->__load();
        return parent::setModifiedDate();
    }

    public function getModifiedDate()
    {
        $this->__load();
        return parent::getModifiedDate();
    }

    public function toArray($ignore_collections = false)
    {
        $this->__load();
        return parent::toArray($ignore_collections);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'title', 'slug', 'description', 'image_id', 'products', 'parent_category', 'child_categories', 'lft', 'rgt', 'root', 'created_date', 'modified_date');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}
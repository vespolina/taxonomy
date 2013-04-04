<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Taxonomy;

use Vespolina\Entity\Taxonomy\TaxonomyNodeInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class TaxonomyNode implements TaxonomyNodeInterface
{
    protected $id;
    protected $name;
    protected $path;
    protected $parent;
    protected $level;
    protected $lockTime;
    protected $attributes;

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setParent(TaxonomyNodeInterface $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @inheritdoc
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @inheritdoc
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @inheritdoc
     */
    public function getLockTime()
    {
        return $this->lockTime;
    }

    /**
     * @inheritdoc
     */
    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addAttributes(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function clearAttributes()
    {
        $this->attributes = array();

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAttribute($name)
    {
        if (isset($this->attributes[$name])) {

            return $this->attributes[$name];
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @inheritdoc
     */
    public function removeAttribute($name)
    {
        unset($this->attributes[$name]);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }
}

<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\Entity\Taxonomy;

use Vespolina\Entity\Taxonomy\TermInterface;

/**
 * @author Daniel Kucharski <daniel@xerias.be>
 */
class Term implements TermInterface
{
    protected $attributes;
    protected $terms;
    protected $name;
    protected $path;
    protected $parent;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function addAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * @inheritdoc
     */
    public function addAttributes(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    /**
     * @inheritdoc
     */
    public function clearAttributes()
    {
        $this->attributes = array();
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
    }

    /**
     * @inheritdoc
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addTerm(TermInterface $term)
    {
        $this->terms[] = $term;
        $rc = new \ReflectionProperty($term, 'parent');
        $rc->setAccessible(true);
        $rc->setValue($term, $this);
        $rc->setAccessible(false);
    }

    /**
     * @inheritdoc
     */
    public function addTerms(array $terms)
    {
        foreach ($terms as $term) {
            $this->addTerm($term);
        }
    }

    /**
     * @inheritdoc
     */
    public function clearTerms()
    {
        $rc = new \ReflectionProperty($this, 'parent');
        $rc->setAccessible(true);

        foreach ($this->terms as $term) {
            $rc->setValue($term, null);
        }
        $rc->setAccessible(false);

        $this->terms = array();
    }

    /**
     * @inheritdoc
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @inheritdoc
     */
    public function removeTerm(TermInterface $term)
    {
        foreach ($this->terms as $key => $termToCompare) {
            if ($termToCompare == $term) {
                unset($this->terms[$key]);
                $rc = new \ReflectionProperty($term, 'parent');
                $rc->setAccessible(true);
                $rc->setValue($term, null);
                $rc->setAccessible(false);

                return;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function setTerms(array $terms)
    {
        $this->clearTerms();
        $this->addTerms($terms);

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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return $this->parent;
    }
}

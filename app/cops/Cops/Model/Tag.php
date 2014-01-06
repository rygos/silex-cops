<?php
/*
 * This file is part of Silex Cops. Licensed under WTFPL
 *
 * (c) Mathieu Duplouy <mathieu.duplouy@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Cops\Model;

use Cops\Model\Common;

/**
 * Tag model
 * @author Mathieu Duplouy <mathieu.duplouy@gmail.com>
 */
class Tag extends Common
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * Number of books
     * @var int
     */
    protected $bookCount;

    /**
     * Books collection
     * @var \Cops\Model\Book\Collection
     */
    private $_books;

    /**
     * Load Tag
     *
     * @param int $tagId
     *
     * @return Tag
     */
    public function load($tagId)
    {
        return $this->setData(
            $this->getResource()->load($tagId)
        );
    }

    /**
     * Get number of books associated to a tag
     *
     * @return int
     */
    public function getNumberOfBooks()
    {
        if (is_null($this->bookCount)) {
            $this->bookCount = $this->getResource()->countBooks($this->getId());
        }
        return $this->bookCount;
    }

    /**
     * Get all books associated to a tag
     *
     * @return Collection
     */
    public function getAllBooks()
    {
        return $this->getModel('Book')->getCollection()->getByTagId($this->getId());
    }
}
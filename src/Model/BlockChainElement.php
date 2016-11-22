<?php

namespace BurdaCodeSlam\ChatBot\Model;
/**
 * Class BlockChainElement
 * @package BurdaCodeSlam\ChatBot\Model
 */
class BlockChainElement
{
    /**
     * @var BlockChainElement
     */
    protected $next = null;
    /**
     * @var string
     */
    protected $data;

    /**
     * BlockChainElement constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param BlockChainElement $element
     */
    public function append(BlockChainElement $element)
    {
        if ($this->next === null) {
            $this->next = $element;
        } else {
            $this->next->append($element);
        }
    }

    /**
     * Get Count of the BlockChain
     * @return int
     */

    public function getCount()
    {
        if ($this->getNext()) {
            return $this->getNext()->getCount() + 1;
        } else {
            return 1;
        }
    }

    /**
     * @return BlockChainElement
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * Returns the BlockChain as String
     *
     */

    public function toString()
    {
        return base64_encode(serialize($this));
    }

    /**
     * Returns the BlockChain as String
     *
     */

    public function printBlockChain()
    {
        $text = $this->data;
        if ($this->getNext()) {
            return $text . " ".$this->getNext()->printBlockChain();
        } else {
            return $text ;
        }
    }


}
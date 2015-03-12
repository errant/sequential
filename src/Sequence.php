<?php
namespace Sequential;

/**
 * A Simple Sequence Generatore, using Redis
 *
 * @category   Sequential
 * @package    Sequence
 * @author     Tom Morton <tom@errant.me.uk>
 * @copyright  2015 Tom Morton
 * @license    MIT
 */
class Sequence {

    protected $_client;
    protected $_data;

    /**
     * Construct Object
     *
     * @author Tom Morton
     * @param mixed $connection Array or String connection for Redis
     */
    public function __construct($connection) 
    {
        $this->_client = new \Predis\Client($connection);
    }

    /**
     * Reset Sequence to 0
     *
     * @author Tom Morton
     * @param string $sequence The Redis key to reset
     */
    public function reset($sequence)
    {
        return $this->_client->getset($sequence, '0');
    }

    /**
     * Gets the Next ID in a Sequence
     *
     * @author Tom Morton
     * @param string $sequence The Redis key to sequence
     */
    public function getNextID($sequence)
    {
        return $this->_client->incr($sequence);
    }

    /**
     * Format the Next ID with a callback
     * 
     * @author Tom Morton
     * @param string $sequence The Redis key to sequence
     * @param callable $formatter Callback which accepts ID string as a parameter and returns a formatted string
     */
    public function getNextIDFormatted($sequence, $formatter)
    {
        if(!is_callable($formatter)) {
            throw new \Exception('Sequential\Sequence excepted Callable as formatter');
        }
        return call_user_func($formatter, (string)$this->getNextID($sequence));
    }
}

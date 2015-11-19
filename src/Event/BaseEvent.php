<?php

namespace AuditStash\Event;

use AuditStash\EventInterface;
use DateTime;

/**
 * Represents a change in the repository where the list of changes can be
 * tracked as a list of properties and thier values.
 */
abstract class BaseEvent implements EventInterface
{
    use BaseEventTrait;

    /**
     * The array of changed properties for the entity
     *
     * @var array
     */
    protected $changed;

    /**
     * The array of original properties before they got changed
     *
     * @var array
     */
    protected $original;

    /**
     * Construnctor
     *
     * @param string $transationId The global transaction id
     * @param mixed $id The primary key record that got deleted
     * @param string $source The name of the source (table) where the record was deleted
     * @param array $changed The array of changes that got detected for the entity
     * @param array $original The original values the entity had before it got changed
     */
    public function __construct($transactionId, $id, $source, $changed, $original)
    {
        $this->transactionId = $transactionId;
        $this->id = $id;
        $this->source = $source;
        $this->changed = $changed;
        $this->original = $original;
        $this->timestamp = (new DateTime)->format('U');
    }

    /**
     * Returns an array with the properties and their values before they got changed
     *
     * @return array
     */
    public function getOriginal()
    {
        return $this->original;
    }

    /**
     * Returns an array with the properties and their values as they were changed
     *
     * @return array
     */
    public function getChanged()
    {
        return $this->changed;
    }

    /**
     * Returns the name of this event type
     *
     * @return string
     */
    abstract public function getEventType();
}

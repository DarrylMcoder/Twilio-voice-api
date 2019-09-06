<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Studio\V1\Flow;

use Twilio\Options;
use Twilio\Values;

abstract class ExecutionOptions {
    /**
     * @param \DateTime $dateCreatedFrom Only show Executions that started on or
     *                                   after this ISO 8601 date-time
     * @param \DateTime $dateCreatedTo Only show Executions that started before
     *                                 this ISO 8601 date-time
     * @return ReadExecutionOptions Options builder
     */
    public static function read($dateCreatedFrom = Values::NONE, $dateCreatedTo = Values::NONE) {
        return new ReadExecutionOptions($dateCreatedFrom, $dateCreatedTo);
    }

    /**
     * @param array $parameters JSON data that will be added to the Flow's context
     * @return CreateExecutionOptions Options builder
     */
    public static function create($parameters = Values::NONE) {
        return new CreateExecutionOptions($parameters);
    }
}

class ReadExecutionOptions extends Options {
    /**
     * @param \DateTime $dateCreatedFrom Only show Executions that started on or
     *                                   after this ISO 8601 date-time
     * @param \DateTime $dateCreatedTo Only show Executions that started before
     *                                 this ISO 8601 date-time
     */
    public function __construct($dateCreatedFrom = Values::NONE, $dateCreatedTo = Values::NONE) {
        $this->options['dateCreatedFrom'] = $dateCreatedFrom;
        $this->options['dateCreatedTo'] = $dateCreatedTo;
    }

    /**
     * Only show Execution resources starting on or after this [ISO 8601](http://www.iso.org/iso/home/standards/iso8601.htm) date-time, given as `YYYY-MM-DDThh:mm:ss-hh:mm`.
     *
     * @param \DateTime $dateCreatedFrom Only show Executions that started on or
     *                                   after this ISO 8601 date-time
     * @return $this Fluent Builder
     */
    public function setDateCreatedFrom($dateCreatedFrom) {
        $this->options['dateCreatedFrom'] = $dateCreatedFrom;
        return $this;
    }

    /**
     * Only show Execution resources starting before this [ISO 8601](http://www.iso.org/iso/home/standards/iso8601.htm) date-time, given as `YYYY-MM-DDThh:mm:ss-hh:mm`.
     *
     * @param \DateTime $dateCreatedTo Only show Executions that started before
     *                                 this ISO 8601 date-time
     * @return $this Fluent Builder
     */
    public function setDateCreatedTo($dateCreatedTo) {
        $this->options['dateCreatedTo'] = $dateCreatedTo;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Studio.V1.ReadExecutionOptions ' . implode(' ', $options) . ']';
    }
}

class CreateExecutionOptions extends Options {
    /**
     * @param array $parameters JSON data that will be added to the Flow's context
     */
    public function __construct($parameters = Values::NONE) {
        $this->options['parameters'] = $parameters;
    }

    /**
     * JSON data that will be added to the Flow's context and that can be accessed as variables inside your Flow. For example, if you pass in `Parameters={"name":"Zeke"}`, a widget in your Flow can reference the variable `{{flow.data.name}}`, which returns "Zeke". Note: the JSON value must explicitly be passed as a string, not as a hash object. Depending on your particular HTTP library, you may need to add quotes or URL encode the JSON string.
     *
     * @param array $parameters JSON data that will be added to the Flow's context
     * @return $this Fluent Builder
     */
    public function setParameters($parameters) {
        $this->options['parameters'] = $parameters;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Studio.V1.CreateExecutionOptions ' . implode(' ', $options) . ']';
    }
}
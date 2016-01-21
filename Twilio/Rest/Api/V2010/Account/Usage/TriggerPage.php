<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Usage;

use Twilio\Page;
use Twilio\Values;

class TriggerPage extends Page {
    public function __construct($version, $response, $accountSid) {
        parent::__construct($version, $response);
        
        // Path Solution
        $this->solution = array(
            'accountSid' => $accountSid
        );
    }

    /**
     * Create a new TriggerInstance
     * 
     * @param string $callbackUrl URL Twilio will request when the trigger fires
     * @param string $triggerValue the value at which the trigger will fire
     * @param trigger.UsageCategory $usageCategory The usage category the trigger
     *                                             watches
     * @param array $options Optional Arguments
     * @return TriggerInstance Newly created TriggerInstance
     */
    public function create($callbackUrl, $triggerValue, $usageCategory, array $options = array()) {
        $options = new Values($options);
        
        $data = Values::of(array(
            'CallbackUrl' => $callbackUrl,
            'TriggerValue' => $triggerValue,
            'UsageCategory' => $usageCategory,
            'CallbackMethod' => $options['callbackMethod'],
            'FriendlyName' => $options['friendlyName'],
            'Recurring' => $options['recurring'],
            'TriggerBy' => $options['triggerBy'],
        ));
        
        $payload = $this->version->create(
            'POST',
            $this->uri,
            array(),
            $data
        );
        
        return new TriggerInstance(
            $this->version,
            $payload,
            $this->solution['accountSid']
        );
    }

    /**
     * Streams TriggerInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     * 
     * @param array $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param int $pageSize Number of records to fetch per request, when not set
     *                      will use
     *                      the default value of 50 records.  If no page_size is
     *                      defined
     *                      but a limit is defined, stream() will attempt to read
     *                      the
     *                      limit with the most efficient page size, i.e.
     *                      min(limit, 1000)
     * @return Stream stream of results
     */
    public function stream(array $options = array(), $limit = null, $pageSize = null) {
        $limits = $this->version->readLimits($limit, $pageSize);
        
        $page = $this->page($options, $limits['pageSize']);
        
        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads TriggerInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     * 
     * @param array $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param int $pageSize Number of records to fetch per request, when not set
     *                      will use
     *                      the default value of 50 records.  If no page_size is
     *                      defined
     *                      but a limit is defined, read() will attempt to read the
     *                      limit with the most efficient page size, i.e.
     *                      min(limit, 1000)
     * @return TriggerInstance[] Array of results
     */
    public function read(array $options = array(), $limit = null, $pageSize = Values::NONE) {
        return iterator_to_array($this->stream($options, $limit, $pageSize));
    }

    /**
     * Retrieve a single page of TriggerInstance records from the API.
     * Request is executed immediately
     * 
     * @param array $options Optional Arguments
     * @param int $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param int $pageNumber Page Number, this value is simply for client state
     * @return Page Page of TriggerInstance
     */
    public function page(array $options = array(), $pageSize = Values::NONE, $pageToken = Values::NONE, $pageNumber = Values::NONE) {
        $options = new Values($options);
        $params = Values::of(array(
            'Recurring' => $options['recurring'],
            'TriggerBy' => $options['triggerBy'],
            'UsageCategory' => $options['usageCategory'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ));
        
        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );
        
        return new TriggerPage(
            $this->version,
            $response,
            $this->solution['accountSid']
        );
    }

    public function buildInstance(array $payload) {
        return new TriggerInstance(
            $this->version,
            $payload,
            $this->solution['accountSid']
        );
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Api.V2010.TriggerPage]';
    }
}
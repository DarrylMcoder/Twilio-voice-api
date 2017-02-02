<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Conference;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Version;

/**
 * @property string accountSid
 * @property string callSid
 * @property string conferenceSid
 * @property \DateTime dateCreated
 * @property \DateTime dateUpdated
 * @property string endConferenceOnExit
 * @property string muted
 * @property string hold
 * @property string startConferenceOnEnter
 * @property string status
 * @property string uri
 */
class ParticipantInstance extends InstanceResource {
    /**
     * Initialize the ParticipantInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid The unique sid that identifies this account
     * @param string $conferenceSid A string that uniquely identifies this
     *                              conference
     * @param string $callSid The call_sid
     * @return \Twilio\Rest\Api\V2010\Account\Conference\ParticipantInstance 
     */
    public function __construct(Version $version, array $payload, $accountSid, $conferenceSid, $callSid = null) {
        parent::__construct($version);
        
        // Marshaled Properties
        $this->properties = array(
            'accountSid' => $payload['account_sid'],
            'callSid' => $payload['call_sid'],
            'conferenceSid' => $payload['conference_sid'],
            'dateCreated' => Deserialize::dateTime($payload['date_created']),
            'dateUpdated' => Deserialize::dateTime($payload['date_updated']),
            'endConferenceOnExit' => $payload['end_conference_on_exit'],
            'muted' => $payload['muted'],
            'hold' => $payload['hold'],
            'startConferenceOnEnter' => $payload['start_conference_on_enter'],
            'status' => $payload['status'],
            'uri' => $payload['uri'],
        );
        
        $this->solution = array(
            'accountSid' => $accountSid,
            'conferenceSid' => $conferenceSid,
            'callSid' => $callSid ?: $this->properties['callSid'],
        );
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     * 
     * @return \Twilio\Rest\Api\V2010\Account\Conference\ParticipantContext Context
     *                                                                      for
     *                                                                      this
     *                                                                      ParticipantInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new ParticipantContext(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['conferenceSid'],
                $this->solution['callSid']
            );
        }
        
        return $this->context;
    }

    /**
     * Fetch a ParticipantInstance
     * 
     * @return ParticipantInstance Fetched ParticipantInstance
     */
    public function fetch() {
        return $this->proxy()->fetch();
    }

    /**
     * Update the ParticipantInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return ParticipantInstance Updated ParticipantInstance
     */
    public function update($options = array()) {
        return $this->proxy()->update(
            $options
        );
    }

    /**
     * Deletes the ParticipantInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete() {
        return $this->proxy()->delete();
    }

    /**
     * Magic getter to access properties
     * 
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }
        
        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Api.V2010.ParticipantInstance ' . implode(' ', $context) . ']';
    }
}
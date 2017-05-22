<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Fax\V1\Fax;

use Twilio\InstanceContext;
use Twilio\Values;
use Twilio\Version;

class FaxMediaContext extends InstanceContext {
    /**
     * Initialize the FaxMediaContext
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $faxSid The fax_sid
     * @param string $sid The sid
     * @return \Twilio\Rest\Fax\V1\Fax\FaxMediaContext 
     */
    public function __construct(Version $version, $faxSid, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array(
            'faxSid' => $faxSid,
            'sid' => $sid,
        );

        $this->uri = '/Faxes/' . rawurlencode($faxSid) . '/Media/' . rawurlencode($sid) . '';
    }

    /**
     * Fetch a FaxMediaInstance
     * 
     * @return FaxMediaInstance Fetched FaxMediaInstance
     */
    public function fetch() {
        $params = Values::of(array());

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new FaxMediaInstance(
            $this->version,
            $payload,
            $this->solution['faxSid'],
            $this->solution['sid']
        );
    }

    /**
     * Deletes the FaxMediaInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete() {
        return $this->version->delete('delete', $this->uri);
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
        return '[Twilio.Fax.V1.FaxMediaContext ' . implode(' ', $context) . ']';
    }
}
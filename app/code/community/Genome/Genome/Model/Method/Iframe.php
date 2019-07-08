<?php
class Genome_Genome_Model_Method_Iframe extends Genome_Genome_Model_Method_Abstract {
    /**
     * Constructor method.
     * Set some internal properties
     */
    public function __construct() {
        parent::__construct('iframe');
    }

    public function getOrderPlaceRedirectUrl() {
        return Mage::getUrl('genome/payment/iframe', array('_secure' => true));
    }

    /**
     * Generate Genome Button
     * @param $order
     * @return ButtonBuilder
     */
    public function getPaymentWidget(Mage_Sales_Model_Order $order) {
        $this->initGenomeConfig();

		return $this->getScriney()->
			buildButton($this->getCustomerIdentifier($order))->
			setUserInfo($this->prepareUserProfile($order))->
			setCustomProducts($this->prepareProducts($order));
    }
}
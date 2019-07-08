<?php
/**
 *
 * Class Genome_Genome_Block_Checkout_Form_Method_Iframe
 */
class Genome_Genome_Block_Checkout_Form_Method_Iframe extends Genome_Genome_Block_Checkout_Form_Method_Abstract
{
    /**
     * Set template for block
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setPaymentModelName('iframe');
    }

    function getWidget()
    {
        $order = $this->getOrder();
        $return = array(
            'content' => '',
            'status' => false
        );

        if ($order) {
            try {
				$store = Mage::app()->getStore()->getStoreId();
                $model = $this->getPaymentModel();
                // Get widget button
                $widget = $model->getPaymentWidget($order);
				$return['content'] = $widget->buildFrame(
					Mage::getStoreConfig('payment/genome_iframe/genome_iframe_height', $store),
					Mage::getStoreConfig('payment/genome_iframe/genome_iframe_width', $store)
				);
                $return['status'] = true;
            } catch (Exception $e) {
                Mage::logException($e);
                $return['content'] = Mage::helper('genome')->__('Errors, Please try again!');
            }
        } else {
            $return['content'] = Mage::helper('genome')->__('Order invalid'); //should redirect back to homepage
        }

        return $return;
    }

    /**
     * Get last order
     */
    protected function getOrder()
    {
        if (!$this->_order) {
            $session = Mage::getSingleton('checkout/session');
            $this->_order = $this->loadOrderById($session->getLastRealOrderId());
        }
        return $this->_order;
    }

    protected function loadOrderById($orderId)
    {
        return Mage::getModel('sales/order')->loadByIncrementId($orderId);
    }
}
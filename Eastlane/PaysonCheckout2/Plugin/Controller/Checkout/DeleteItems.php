<?php
namespace Eastlane\PaysonCheckout2\Plugin\Controller\Checkout;
/**
 * Class DeleteItems
 *
 * @package Eastlane\PaysonCheckout2\Plugin\Controller\Checkout
 */
class DeleteItems
{
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_url;
    /**
     * @var \Magento\Framework\App\Response\Http
     */
    protected $_response;
    /**
     * @var \Eastlane\PaysonCheckout2\Model\Config
     */
    protected $paysonConfig;
    /**
     * @var \Eastlane\PaysonCheckout2\Helper\Order
     */
    protected $_orderHelper;

    /**
     * DeleteItems constructor.
     *
     * @param \Magento\Framework\UrlInterface        $url
     * @param \Magento\Framework\App\Response\Http   $response
     * @param \Eastlane\PaysonCheckout2\Model\Config $paysonConfig
     * @param \Eastlane\PaysonCheckout2\Helper\Order $orderHelper
     */
    public function __construct(
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\App\Response\Http $response,
        \Eastlane\PaysonCheckout2\Model\Config $paysonConfig,
        \Eastlane\PaysonCheckout2\Helper\Order $orderHelper
    ) {
        $this->_url = $url;
        $this->_response = $response;
        $this->paysonConfig = $paysonConfig;
        $this->_orderHelper = $orderHelper;
    }

    /**
     * @param $controller
     */
    public function afterExecute($controller)
    {
        if ($this->paysonConfig->isEnabled()) {
            if ($this->_orderHelper->hasActiveQuote()) {
                $quote =  $this->_orderHelper->getQuote();
                if ($quote->getPaysonCheckoutId()) {
                    $this->_orderHelper->updateCart($quote->getPaysonCheckoutId());
                }
                $checkoutPaysonUrl = $this->_url->getUrl('checkout/payson');
                $this->_response->setRedirect($checkoutPaysonUrl)->sendResponse();
            } else {
                $checkoutPaysonUrl = $this->_url->getUrl('checkout/payson/emptycart');
                $this->_response->setRedirect($checkoutPaysonUrl)->sendResponse();
            }
        }
    }
}

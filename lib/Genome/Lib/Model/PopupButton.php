<?php

namespace Genome\Lib\Model;

/**
 * Class PopupButton
 * @package Genome\Lib\Model
 */
class PopupButton extends BaseButton
{
    /** @var string */
    private $codeStart = "<div><form class='genomePaymentForm'><script class='genomeScript' ";

    /** @var string */
    private $codeEnd = "></script></form></div>";

    /** @var string */
    private $baseHost;

    public function __construct($baseHost)
    {
        $this->baseHost = $baseHost;
        $this->pushValue('type', 'popup');
        $this->pushValue('iframesrc', $this->baseHost . 'hpp');
    }

    /** @return string */
    public function build()
    {
        $body = "src='". $this->baseHost ."client.js' ";
        foreach ($this->fieldList as $key => $value) {
            $body  .= "data-" . $key . "='" . $value . "' ";
        }

        $this->buttonCode = $this->codeStart . $body . $this->codeEnd;
    }
}

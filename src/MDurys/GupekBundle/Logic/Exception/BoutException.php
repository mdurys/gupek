<?php

namespace MDurys\GupekBundle\Logic\Exception;

class BoutException extends \RuntimeException
{
    /**
     * @return string
     */
    public function getTransMessage()
    {
        return 'exception.bout.'.parent::getMessage();
    }
}

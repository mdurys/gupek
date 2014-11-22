<?php

namespace MDurys\GupekBundle\Logic\Exception;

class BoutException extends \RuntimeException
{
    public function getTransMessage()
    {
        return 'exception.bout.'.parent::getMessage();
    }
}

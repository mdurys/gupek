<?php

namespace MDurys\GupekBundle\Logic\Exception;

class MeetingException extends \RuntimeException
{
    /**
     * @return string
     */
    public function getTransMessage()
    {
        return 'exception.meeting.'.parent::getMessage();
    }
}

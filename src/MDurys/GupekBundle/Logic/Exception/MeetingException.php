<?php

namespace MDurys\GupekBundle\Logic\Exception;

class MeetingException extends \RuntimeException
{
    public function getTransMessage()
    {
        return 'exception.meeting.'.parent::getMessage();
    }
}

<?php

namespace Empari\MailFinder\MailFinder\Traits;

use Empari\MailFinder\MailFinder;

trait MailFindable
{
    /**
     * Verify if email is valid
     *
     * @return bool
     */
    public function isEmailValid()
    {
        $class_vars = get_object_vars($this)['attributes'];

        if (in_array($class_vars, ['email'])) {
            return false;
        }

        return MailFinder::isValid($this->email);
    }
}
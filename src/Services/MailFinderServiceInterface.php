<?php

namespace Empari\MailFinder\Services;

/**
 * Interface MailFinderServiceInterface
 * @package Naweby\Support\Utils\MailFinder\Services
 */
interface MailFinderServiceInterface
{
    /**
     * Verify if email is valid
     *
     * @param string $email
     * @return bool
     */
    public function isValid(string $email);
}
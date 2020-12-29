<?php
namespace GuylianGilsing\PhpSession;

class Session extends AbstractSession
{
    public static function getExisting(string $name) : ?AbstractSession
    {
        if(!isset($_SESSION[$name]))
            return null;

        $session = new Session($name);
        $session->setData($_SESSION[$name]['_data']);
        
        return $session;
    }
}

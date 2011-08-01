<?php
/**
 * Book - My Mini Library Application
 * Copyright (c) 2011, Sarjono Mukti Aji <http://simukti.net/>
 * 
 * See full license on LICENSE.txt
 */

/**
 * Version
 * 
 * @author Sarjono Mukti Aji <http://simukti.net/>
 * @copyright (c) 2011 - Sarjono Mukti Aji <http://simukti.net/>
 */
final class Core_Version
{
    protected static $_version = '1.1';
    protected static $_appName = 'My Mini Library';
    
    public static function getVersion()
    {
        return self::$_version;
    }
    
    public static function getAppName()
    {
        return self::$_appName;
    }
}

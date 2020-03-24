<?php
namespace Boyo\Viberbot\Exceptions;

class ViberBotException extends \Exception
{
	
	/**
     * Thrown when there is no viber id 
     *
     * @return static
     */
    public static function missingViberId()
    {
        return new static('The user does not have a valid viber id.');
    }
    
	/**
     * Thrown when there is no message type set
     *
     * @return static
     */    
    public static function missingMessageType()
    {
	    return new static('Missing a required parameter: message type.');
    }
    
	/**
     * Thrown when there is no message body set
     *
     * @return static
     */    
    public static function missingMessageBody()
    {
	    return new static('Missing a required parameter: message body.');
    }    
    
	/**
     * Thrown when there is no valid message object passed to Client
     *
     * @return static
     */
    public static function noMessageProvided()
    {
	    return new static('No message provided');
    }   
    
	/**
     * Thrown when there is no valid ViberUser object passed to Client
     *
     * @return static
     */
    public static function noReceiverProvided()
    {
	    return new static('No receiver provided');
    }
}
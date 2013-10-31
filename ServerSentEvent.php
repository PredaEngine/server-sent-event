<?php
/**
*	@author 	PredaEngine (David LBD)
*	@copyright	LBD Conception
*	@since 		01 Nov 2013
*	@version 	1.0.0
*	@link 		https://github.com/PredaEngine/server-sent-event
*/
class ServerSentEvent
{
	/**
    *	@var 	ServerSentEvent
    */
	private static $_instance;

	// Disabled in order to user Singleton Pattern
	private function __construct()
	{

	}

	/**
	*	@param callable $callback Will be executed at a regular interval
	*	@param int 		$interval Interval between execution
	*	@return void
	*/
	public function process(callable $callback,$interval)
	{
		if(!is_int($interval) or !is_callable($callback))
			throw new Exception("Error during process", 1);

		while(1){
			call_user_func($callback,$this);
			sleep($interval);
		}	
	}
	/**
	*	@param array 	$message Contains différents informations that will be send to client
	*	@return void
	*/
	public function send(array $message)
	{
		if (!is_array($message))
			throw new Exception("$message must be an array", 1);
			
		if(isset($message['event'])){
			echo "event: ". $message['event'] ."\n";
		}
		if(isset($message['id'])){
			echo "id: ". $message['id'] ."\n";
		}
		if(isset($message['data']) && is_array($message['data'])){
			foreach ($message['data'] as $data) {
				echo "data: ". $data ." \n";
			}
		}
		else{
			echo "data: ". $message['data'] ." \n";
		}
		echo "\n\n";
		ob_flush();
		flush();
	}

	public static function getInstance()
	{
		if( true === is_null( self::$_instance ) )
			self::$_instance = new self();

		return self::$_instance;
	}
}
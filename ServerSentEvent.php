<?php
/**
*	@author 	PredaEngine (David LBD)
*	@version 	1.0.0
*/
class ServerSentEvent
{
	/**
    * @var ServerSentEvent
    */
	private static $_instance;

	private function __construct()
	{}

	public function process($callback,$interval)
	{
		if(!is_int($interval) or !is_callable($callback))
			throw new Exception("Error during process", 1);

		while(1){
			call_user_func($callback,$this);
			sleep($interval);
		}	
	}

	public function send(array $message)
	{
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
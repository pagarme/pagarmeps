<?php
class PagarMe_Transaction extends PagarMe_TransactionCommon {

	public function charge() 
	{
		$this->create();
	}

	public function capture($amount = false)
	{
			$request = new PagarMe_Request(self::getUrl().'/'.$this->id . '/capture', 'POST');
			if($amount) { 
				$request->setParameters(array('amount' => $amount));
			}
			$response = $request->run();
			$this->refresh($response);
	}
	
	public function captureAdv($amount = false, $postbackUrl = false, $metadata = false)
	{
			$request = new PagarMe_Request(self::getUrl().'/'.$this->id . '/capture', 'POST');
			
			$params = array();
			if($amount) { 
				$params['amount'] = $amount;
			}
			if($postbackUrl) { 
				$params['postback_url'] = $postbackUrl;
			}
			if($metadata) { 
				$params['metadata'] = $metadata;
			}
			
			$request->setParameters($params);
			$response = $request->run();
			$this->refresh($response);
	}

	public function refund($params = array()) 
	{
			$request = new PagarMe_Request(self::getUrl().'/'.$this->id . '/refund', 'POST');
			$request->setParameters($params);
			$response = $request->run();
			$this->refresh($response);
	}
}

?>

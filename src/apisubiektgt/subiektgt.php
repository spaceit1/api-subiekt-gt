<?php
namespace APISubiektGT;
use APISubiektGT\Config;
use APISubiektGT\Logger;
use APISubiektGT\SubiektGT\Order;
use COM;

class SubiektGT {
	static protected $_instance;
	protected $cfg;
	protected $subiektGt;

	public function __construct(Config $cfg){
		$this->cfg = $cfg;

	}


	static public function getInstance(Config $cfg = null){
		if(!self::$_instance){
			self::$_instance = new SubiektGT($cfg);
		}
		return self::$_instance;
	}


	/**
	*	create com Object
	*/
	public function connect(){
		$gt = new COM("InsERT.GT") or die("Cannot create an InsERT GT object");
		$gtD = new COM("InsERT.Dodatki") or die("Cannot create an Insert Dodatki object");

		$gt->Produkt = 1;
		$gt->Autentykacja = 0;				
		$gt->Serwer = $this->cfg->getServer();
		$gt->Uzytkownik = $this->cfg->getDbUser();
		$gt->UzytkownikHaslo = $gtD->Szyfruj($this->cfg->getDbUserPass());
		$gt->Baza = $this->cfg->getDatabase();
		//$gt->Operator = "Szef";
		//$gt->OperatorHaslo = $gtD->Szyfruj("luke123");
 
		 $this->subiektGt = $gt->Uruchom(0,4);
		 return $this->subiektGt;
	}


	public function addOrder($data){
		//$order = new Order($this->subiektGt, $data['data']);
		$order = new Order($this->subiektGt, $data['data']);		
	
		//var_Dump($sDoc->Liczba);
		//$doc = $this->subiektGt->Dokumenty->Wczytaj("FZ 2607/MAG/10/2017");
		//var_dump($doc->KontrahentId());

	}

}
?>
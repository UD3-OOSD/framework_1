<?php

class InitService implements ServiceState{

  private static $initservice = NULL;
  private static $ServiceActiveModel;

  private function __construct(){
      InitService::$ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
  }

  public static function getInstance(){
    if(!isset(InitService::$initservice)){
      InitService::$initservice = new InitService();
    }
    return InitService::$initservice;
  }

  public function stateChange($service){
      if($service->get_trigger()){
          $service->setState('3');
          InitService::$ServiceActiveModel->stateChange($service->getId(),3);

      }else{
          $service->setState('8');
          InitService::$ServiceActiveModel->stateChange($service->getId(),8);

      }
  }

  public function edit($service, $data){
    $service->setAttrs($data);
    $this->TableUpdate($data);
  }



    public function TableUpdate($data){
        InitService::$ServiceActiveModel->edit($data['ServiceId'],$data);
    }

    public function fillAction($params)
    {
        //not needed
        // TODO: Implement fillAction() method.
    }
}

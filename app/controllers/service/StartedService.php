<?php

class StartedService implements ServiceState{


  private static $stservice = NULL;
  private static $ServiceActiveModel;

  private function __construct(){
      StartedService::$ServiceActiveModel = ModelCommon::loading_model('ServiceActive');
  }

  public static function getInstance(){
    if(!isset(StartedService::$stservice)){
      StartedService::$stservice = new StartedService();
    }
    return StartedService::$stservice;
  }

  public function stateChange($service){
    $service->setState('5');
    StartedService::$ServiceActiveModel->stateChange($service->getId(),5);
  }

  public function getState()
    {
        // TODO: Implement getState() method.
    }

    public function edit($service, $data)
    {
        // TODO: Implement edit() method.
    }

    public function fillAction($params)
    {
        // TODO: Implement fillAction() method.
    }
}

<?php

require_once(ROOT.DS.'app'.DS.'controllers'.DS.'bus'.DS.'BusState.php');


class NewBus extends Controller implements BusState{

  public function __construct(){
    $this->fillAction();
  }

  public function stateChange($bus){
    $bus->setState(new EdittingBus());
  }

  public function fillAction(){
    $validation = new Validate();
    $posted_values = ['BusNumber' => '', 'EngineNumber' => '', 'BusCategory' => '' , 'RegistrationDate' => ''];
    if(isset($_POST['vehicle_num'])){
      $posted_values = posted_values($_POST);
      $validation->check($_POST,[
        'BusNumber' => [
          'display' => 'Vehicle Number',
          'require' => true,
          'unique' => 'bustable',
          'min' => 8  #check
        ],
        'EngineNumber' => [
          'display' => 'Engine number',
          'require' => true,
          'unique' => 'bustable',
          'min' => 6,
        ],
        'BusCategory' => [
          'display' => 'Bus Make',
          'require' => true,
          'unique' => 'buscategory'
        ],
        'RegistrationDate' => [
          'display' => 'Registration Date',
          'require' => true
        ]
      ]);

      if ($validation->passed()){
        $this->load_model('BusM');
        $this->BusMModel->registerNewBus($_POST);
        Router::redirect('admin');  #will have to change
      }

    }
    //create a record and fill it.-> goto BusModel.
  }

  private function BusMaintainanceDistances($type){
    #not needed right now
<<<<<<< HEAD
=======
  }
>>>>>>> ed406f1ec0aa4569ce583d8b5315b8ad9049c01c
}

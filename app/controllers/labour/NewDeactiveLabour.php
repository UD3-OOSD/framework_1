<?php

class NewDeactiveLabour extends Controller implements LabourState{

  public function __construct($lab, $data){
    $this->fill($lab,$data);
  }

  public function stateChange($lab){
    $lab->setState(new NewActiveLabour());
  }

  public function fill($lab,$data){
    $lab->setAttr($data);
  }

  public function send_mail($lab){
    //send verification key in a email. @avishka
    //gerate it -> save it in the db
    // send url also.  @devin
  }

  public function loadActivatePage($id){ // this $id will auto feed by Router.
    //this is the method handle activation. @devin
    // load $lab by $_POST['id']   @avishka
    $this->checkValidation($id);
    //if invalide key.
    $this->view->render('validation');
    //else
    $this->stateChange($lab);
    $lab->getState()->edit();
    
  }

  public function checkValidation($id){
    //fetch data. @avishka
  }


}
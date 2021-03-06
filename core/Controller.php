<?php

  class Controller extends Application{

    protected $_controller, $_action;
    public $view;

    public function __construct($controller,$action,$id=''){
      parent::__construct();
      $this->_controller = $controller;
      $this->_action = $action;
      $this->view = new View();
    }

    protected function load_model($model,$acl='Other'){
      if (class_exists($model)) {
        $this->{$model.'Model'} = new $model(strtolower($model),$acl);

      }
    }

    protected function load_system($system){
        if(class_exists($system)){
            $this->{$system} = new $system(strtolower($system));
        }
    }
  }

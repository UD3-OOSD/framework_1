<?php

interface BusState{
  // here we call and link to the busModel. ?if is it possible.
  public function stateChange($bus);
  public function updateDistance();
  public function show($id);


}

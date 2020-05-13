<?php $this->setSiteTitle('Bus Registration Form') ?>

<?php $this->start('head') ?>
<link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8" >
<?php $this->end() ?>

<?php $this->start('body') ?>
<div class="container">
        <div class="row register">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 reg">
                <h1>Bus Registration Form</h1>
                <form class="form-horizontal hr" method="post" >
                  <div class="dg-danger"><?= $this->displayErrors ?></div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Registration No.</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="BusNumber" name='BusNumber' placeholder="Ex:- WP NA-XXXX" value="<?=$this->post['BusNumber']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Date of Registration</label>
                        <div class="col-sm-4">
                            <input type="date" id="RegistrationDate" name='RegistrationDate' class="form-control" value="<?=$this->post['RegistrationDate']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Chassis Number</label>
                        <div class="col-sm-6">
                            <input type="text" id="EngineNumber" name='EngineNumber' class="form-control" value="<?=$this->post['EngineNumber']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Manufactured Year</label>
                        <div class="col-sm-3">
                            <input type="number" id="ManufacturedYear" name='ManufacturedYear' class="form-control" value="<?=$this->post['ManufacturedYear']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Model</label>
                        <div class="col-sm-6">
                            <input type="text" id="BusCategory" name='BusCategory' class="form-control" value="<?=$this->post['BusCategory']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Colour</label>
                        <div class="col-sm-6">
                            <input type="text" id="Colour" name='Colour' class="form-control" value="<?=$this->post['Colour']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Current Mileage (km)</label>
                        <div class="col-sm-3">
                            <input type="number" id="Mileage" name='Mileage' class="form-control"  value="<?=$this->post['Mileage']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">No of seats</label>
                        <div class="col-sm-2">
                            <input type="number"  id="NumberOfSeats" name='NumberOfSeats' class="form-control" value="<?=$this->post['NumberOfSeats']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember">I accept that this registration form is completed only by myself.</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-2">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                        <div class="col-sm-offset-1 col-sm-2">
                            <a href=""><button type="button" class="btn btn-default">Refresh</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $this->end() ?>

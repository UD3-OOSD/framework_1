<?php $this->setSiteTitle('Bus Registration Form') ?>

<?php $this->start('head') ?>
<script type="text/javascript" src="<?=PROOT?>js/tools.js"></script>
<link rel="stylesheet" href="<?=PROOT?>css/regfo.css" media="screen" title="no title" charset="utf-8" >
<?php $this->end() ?>

<?php $this->start('body') ?>

<div class="container">
    <div class="form-head">
        <div class="col-sm-8 head-text"><h2>bus <b> Registration </b></h2></div>
    </div>
    <div class="bg-danger"><?= $this->displayErrors ?></div>
    <form class="form-horizontal hr" method="post" >
        <div class="form-group">
            <label class="control-label col-sm-4">Registration No.</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="BusNumber" name='BusNumber' placeholder="Ex:- WP NA-XXXX" value="<?=$this->post['BusNumber']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Date of Registration</label>
            <div class="col-sm-4">
                <input type="date" id="date" name='RegistrationDate' class="form-control" onClick="checkDate()" value="<?=$this->post['RegistrationDate']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Chassis Number</label>
            <div class="col-sm-4">
                <input type="text" id="EngineNumber" name='EngineNumber' class="form-control" value="<?=$this->post['EngineNumber']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Manufactured Year</label>
            <div class="col-sm-4">
                <input type="date" id="date" name='ManufacturedYear' class="form-control" onkeyup="checkDate()" value="<?=$this->post['ManufacturedYear']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Model</label>
            <div class="col-sm-4">
                <select clid="list" name="BusCategory" class="form-control">
                    <option value="<?=$this->post['BusCategory']?>" selected hidden><p><?=$this->post['BusCategory']?></p></option>
                    <option value="Demo">Demo</option>
                    <option value="Honda">Honda</option>
                    <option value="Layland">Leyland</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Colour</label>
            <div class="col-sm-4">
                <input type="text" id="Colour" name='Colour' class="form-control" value="<?=$this->post['Colour']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">Current Mileage (km)</label>
            <div class="col-sm-4">
                <input type="number" id="number" name='Mileage' class="form-control" onkeyup="checkNumber()" value="<?=$this->post['Mileage']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4">No of seats</label>
            <div class="col-sm-4">
                <input type="number"  id="number" name='NumberOfSeats' class="form-control" onkeyup="checkNumber()" value="<?=$this->post['NumberOfSeats']?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <div class="checkbox">
                    <label><input type="checkbox" name="remember" required>I accept that this registration form is completed only by myself.</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
            <div class="col-sm-offset col-sm-3">
                <a href=""><button type="button" class="btn btn-default">Refresh</button></a>
            </div>
        </div>
    </form>
</div>


<?php $this->end() ?>

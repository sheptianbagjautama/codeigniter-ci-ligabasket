<section class="row">
    
    <div class="col-sm-12 col-lg-8">
    <div class="card">
        <div class="card-block">
        <form name='hallSchedules' method='post' action=<?= current_url() . '/add'?>>
        <div class="card-title dropdown">
        <select name="hall" class="custom-select form-control">
            <option value="" selected="">--Pilih Lapangan--</option>
            <?php foreach ($halls as $idx=>$row) { ?>
                <option value= <?= $row->id ?> > <?=  $row->name ?> </option>
            <?php } ?>
        </select>
        <div style="margin-top: 10px;">
            <label for="halldate" class="col-sm-12 col-form-label">Tanggal</label>                    
            <div class="col-sm-12">
                <input type="text" name="halldate" value="<?= date("d/m/Y") ?>"  class="form-control datepicker" id="halldate" required="" autofocus="" />
            </div>
        </div>
       </div>


        
        <section class="row">
            <div class="col-sm-12 mt-3 ml-4">
                <div class="form-check">
                    <input id="checkAll" class="form-check-input" type="checkbox" disabled>
                    <label class="form-check-label color-disable" for="checkAll">
                        All Schedules
                    </label>
                </div>
            </div>
        </section>
        
        <section class="row">
        <?php $temp = 0; foreach (array(1,2) as $idx) {  ?>
            <div class="col-sm-6 col-lg-6">
                <?php for($i=$temp; $i < count($schedules); $i++) { $temp++; ?>
                    <div class="schedules-selections ml-4">
                        <div class="form-check">
                            <input class="form-check-input schedule" type="checkbox" id="checkbox<?= $schedules[$i]->id ?>" value=<?= $schedules[$i]->id ?>>
                            <label class="form-check-label" for="checkbox<?= $schedules[$i]->id ?>">
                                <?= $schedules[$i]->range_time ?>
                            </label>
                        </div>
                    </div>
                <?php if($i == 6)  break; } ?>
            </div>
        <?php } ?>
        </section>
        <section class="row mt-4">
            <div class="col-sm-12 col-lg-12">     
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </section>
    </form>
        </div>
    </div>
        
    </div>
    
</div>




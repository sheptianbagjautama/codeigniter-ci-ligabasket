<section class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-block">
                <table id="dataTable" class="table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Team</th>
                            <th>MP</th>
                            <th>W</th>
                            <th>WO</th>
                            <th>LO</th>
                            <th>L</th>
                            <th>PTS</th>
                            <th>PTC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $idx=>$row) { ?>
                            <tr>
                                <td><?= ++$idx; ?></td>
                                <td><?= $row->team; ?></td>
                                <td><?= $row->mp; ?></td>
                                <td><?= $row->w; ?></td>
                                <td><?= $row->wo; ?></td>
                                <td><?= $row->lo; ?></td>
                                <td><?= $row->l; ?></td>
                                <td><?= $row->pts; ?></td>
                                <td><?= $row->ptc; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
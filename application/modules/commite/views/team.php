<section class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-block">
                <table id="dataTable" class="table-hover table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Nama Team</th>
                            <th>Deskripsi</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $idx=>$row) { ?>
                            <tr>
                                <td><?= ++$idx; ?></td>
                                <td>
                                    <img src="<?= $row->image; ?>" />
                                </td>
                                <td><?= $row->name; ?></td>
                                <td><?= $row->description; ?></td>
                                <td><?= $row->address; ?></td>
                                <td><?= $row->phone; ?></td>
                                <td><?= $row->email; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
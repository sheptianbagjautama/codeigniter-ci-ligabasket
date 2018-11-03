<section class="row">
    <div class="col-sm-8 col-md-8 col-lg-8">
    <div class="card">
        <div class="card-block">
            <table id="dataTable" class="table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>No Telepon</th>
                        <th>Alamat Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $idx=>$row) { ?>
                        <tr>
                            <td><?= ++$idx; ?></td>
                            <td><?= $row->name ?></td>
                            <td><?= $row->phone ?></td>
                            <td><?= $row->email; ?></td>
                            <td><button  onclick="return confirm('Apa anda yakin akan menghapus data ini ?')" data-url="" type="button" class="add btn btn-sm btn-danger"></i>Hapus</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
        
    </div>
</section>
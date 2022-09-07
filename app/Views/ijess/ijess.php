<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-success shadow-dark border-radius-lg pt-4 pb-3">
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-white text-capitalize ps-3">
                                        International Jounal of Environmental Sustainability and Social Science (IJESS)
                                    </h6>
                                </div>
                                <div class="col mx-4 mt-2">
                                    <a href="<?= base_url('/ijess/create') ?>" class="btn btn-danger btn-sm" style="float:right;"><span class="material-icons opacity-10">add_circle</span> &nbsp;tambah</a>
                                </div>
                            </div>
                        </div>
                        <div class=" card-body px-0 pb-2">
                            <?php if (session()->getFlashdata('message')) : ?>
                                <div class="alert alert-danger mx-3" role="alert">
                                    <strong class="text-white text-capitalize ps-3"><?= session()->getFlashdata('message'); ?> </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="float:right"></button>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex justify-content-end">
                            <form action="" method="post" class="mx-5 d-flex input-group input-group-outline">
                                <div class="input-group">
                                    <div class="form-outline col-md-11">
                                        <input type="text" id="form1" class="form-control" name="keyword" placeholder="cari..." />
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-secondary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Volume</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                    <tr>
                                        <?php $i = 1; ?>
                                        <?php
                                        foreach ($ijess as $row) :
                                        ?>
                                    <tr>
                                        <th scope="row"><?php echo $i; ?></th>
                                        <td scope="row"><?php echo $row["volume"]; ?></td>
                                        <td scope="row"><?php echo $row["judul"]; ?></td>
                                        <td scope="row"><?php echo $row["author"]; ?></td>
                                        <td scope="row"><?php echo $row["tanggal"]; ?></td>
                                        <td scope="row"><?php echo $row["status"]; ?></td>
                                        <td>
                                            <a href="/ijess/edit/ <?= $row['id'] ?>" class="btn btn-success btn-sm"><span class="material-icons opacity-10">edit</a>
                                            <form action="/ijess/<?= $row['id']; ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?');"><span class="material-icons opacity-10">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach ?>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="<?= base_url('/ijess/print') ?>" class="btn btn-danger btn-md my-2"><span class=" material-icons opacity-10">local_printshop</span> &nbsp; print</a>
    </div>

</main>
<?= $this->endSection() ?>
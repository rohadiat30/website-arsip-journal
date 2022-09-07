<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-8">
                <div class="card my-2 ">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-warning shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">
                                Ubah Data Journal
                            </h6>
                        </div>
                        <div class="row">
                            <form action="/ahjpm/update/ <?= $ahjpm['id']; ?>" method="post" class="my-5 mx-6" role="form" style="width: 80%;">
                                <?= csrf_field(); ?>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control  <?= ($validation->hasError('volume')) ? 'is-invalid' : ''; ?>" name="volume" id="volume" autofocus value="<?= $ahjpm['volume']; ?>">
                                    <div class="invalid-feedback">
                                        Volume harus di isi !
                                    </div>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" name="judul" value="<?= $ahjpm['judul']; ?>" id="judul">
                                    <div class="invalid-feedback">
                                        Judul harus di isi/Unik !
                                    </div>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="text" class="form-control  <?= ($validation->hasError('author')) ? 'is-invalid' : ''; ?>" name="author" value="<?= $ahjpm['author']; ?>" id="author">
                                    <div class="invalid-feedback">
                                        Author harus di isi !
                                    </div>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <input type="date" class="form-control  <?= ($validation->hasError('tanggal')) ? 'is-invalid' : ''; ?>" name="tanggal" value="<?= $ahjpm['tanggal']; ?>" id="tanggal">
                                    <div class="invalid-feedback">
                                        Tanggal harus di isi !
                                    </div>
                                </div>
                                <div class="input-group input-group-outline mb-3">
                                    <select for="status" type="text" class="form-control  <?= ($validation->hasError('status')) ? 'is-invalid' : ''; ?>" name="status" id="status">
                                        <option selected><?= $ahjpm['status']; ?></option>
                                        <option value="1">Lunas</option>
                                        <option value="2">Belum Lunas</option>
                                    </select>
                                </div>
                                <div class="text-left">
                                    <button type="submit" name="submit" class="btn btn-md bg-gradient-info btn-md mt-3 mb-0"><span class="material-icons opacity-10">edit</span> &nbsp;Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
<?= $this->endSection() ?>
<?= $this->extend('layout/v_apk/formtemp'); ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="bg-dark p-1 mb-4">
        <h3 class="text-center text-bold text-white">TAMBAH SURAT KELUAR</h3>
    </div>
    <form action="<?= base_url('simpanSukerl'); ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Nomor Surat</label>
                    <input type="hidden" name="id_instansi" id="" value="<?= idInstansi(); ?>" class="form-control">
                    <input type="text" name="nomor_surat" id="" placeholder="ex. 2090/Un.24/PP.00.9/07/2023" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Perihal</label>
                    <input type="text" name="perihal" id="" placeholder="ex. UNDANGAN REVIEW NASKAH AKADEMIK " class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Tembusan <span>(bisa dikosongkan)</span></label>
                    <input type="text" name="tembusan" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Sifat</label>
                    <select name="id_sifat" id="" class="form-control" required>
                        <option value="">--PILIH SIFAT--</option>
                        <?php foreach ($sifat as $si) : ?>
                            <option value="<?= $si['id_sifat']; ?>"><?= $si['sifat']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-6 ">
                <div class="form-group">
                    <label for="filex" class="d-flex align-items-center">
                        <i class="fas fa-paperclip mr-2"></i> Lampirkan Surat
                    </label>
                    <input type="hidden" name="id_surat">
                    <div class="custom-file">
                        <input type="file" name="filex" class="custom-file-input" id="filex" placeholder="" required>
                        <label class="custom-file-label" for="filex">FORMAT SURAT : .JPG/.JPEG/.PDF</label>
                    </div>
                </div>
                <div class="form-group">
                    <!-- <div class="form-group"> -->
                    <div id="filePreview">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mx-auto">
                <a href="<?= base_url('suratkeluarl'); ?>" type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
</div>


<script>
    document.getElementById('filex').addEventListener('change', function() {
        const fileInput = this;
        const filePreview = document.getElementById('filePreview');
        const label = document.querySelector('.custom-file-label');

        // Ambil nama file dari input
        const fileName = fileInput.files[0] ? fileInput.files[0].name : 'Masukkan Kembali File Surat';
        label.textContent = fileName;

        // Tampilkan tampilan preview jika file dipilih
        if (fileInput.files && fileInput.files[0]) {
            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const fileExtension = file.name.split('.').pop().toLowerCase();

                // Tampilkan preview PDF
                if (fileExtension === 'pdf') {
                    filePreview.innerHTML = `<iframe src="${e.target.result}" width="100%" height="400px" frameborder="0"></iframe>`;
                }
                // Tampilkan preview gambar
                else if (fileExtension === 'jpg' || fileExtension === 'jpeg') {
                    filePreview.innerHTML = `<img src="${e.target.result}" alt="Preview Gambar" width="100%">`;
                }
                // Tipe file tidak dikenali, beri tahu pengguna
                else {
                    filePreview.innerHTML = '<p>Tipe file tidak dikenali. Hanya file PDF, JPG, dan JPEG yang diperbolehkan.</p>';
                }
            };

            reader.readAsDataURL(file);
        } else {
            filePreview.innerHTML = '';
        }
    });
</script>

<?= $this->endSection(); ?>
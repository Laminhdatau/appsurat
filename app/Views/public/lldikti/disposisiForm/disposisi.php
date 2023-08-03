<?= $this->extend('layout/v_apk/formtemp'); ?>

<?= $this->section('content') ?>
<style>
    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .form-check {
        flex-basis: 24%;
        margin-bottom: 10px;
        /* Tambahkan jarak antar form-check */
    }
</style>

<div class="container bg-white shadow jumbotron">

    <div class="bg-dark p-1 mb-4">
        <h3 class="text-center text-bold text-white">DISPOSISIKAN</h3>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>


    <?php echo form_open('disposisill'); ?>
    <div class="form-group">
        <input type="hidden" name="id_surat" id="idku" value="<?= $sumas->id_surat; ?>">

        <div class="row mb-3">
            <select name="daftarpegawai[]" id="daftarpegawai<?= $sumas->id_surat; ?>" multiple required>
                <?php foreach ($daftarPegawai as $p) { ?>
                    <option value="<?= $p['id_pegawai']; ?>"><?= $p['nama_lengkap']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="row ml-1">
            <?php $counter = 0; ?>
            <?php foreach ($instruksi as $in) { ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="instruksi[]" value="<?= $in['id_instruksi']; ?>" id="<?= $in['id_instruksi']; ?>">
                    <label class="form-check-label" for="<?= $in['id_instruksi']; ?>">
                        <?= $in['instruksi']; ?>
                    </label>
                </div>
                <?php $counter++; ?>
                <?php if ($counter % 4 == 0) { ?>
        </div>
        <div class="row ml-1">
        <?php } ?>
    <?php } ?>
        </div>
    </div>


    <div class="form-group float-right">
        <a href="<?= base_url('suratmasukl'); ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        <button class="btn btn-primary" type="submit" name="simpan"><i class="fas fa-book"></i> Disposisi</button>
    </div>
</div>

<script>
    new MultiSelectTag('daftarpegawai<?= $sumas->id_surat; ?>', {
        rounded: true,
        shadow: true,
        searchable: true,
        placeholder: 'Search',
        displayEmptyPlaceholder: true,
        onChange: function(values) {
            console.log(values);
        }
    });

    $('#disposisi button[name="simpan"]').click(function(e) {
        e.preventDefault();
        var daftarpegawai = $('#daftarpegawai').val();
        var instruksi = $('input[name="instruksi[]"]:checked').map(function() {
            return $(this).val();
        }).get();

        // Validasi jika field daftarpegawai tidak diisi
        if (!daftarpegawai || daftarpegawai.length === '0') {
            alert('Pilih setidaknya satu pegawai untuk disposisi.');
            return;
        }

        // Validasi jika field instruksi tidak diisi
        if (!instruksi || instruksi.length === '0') {
            alert('Pilih setidaknya satu instruksi untuk disposisi.');
            return;
        }

        // Jika validasi terpenuhi, maka kirim data melalui AJAX
        $.ajax({
            url: '<?= base_url('disposisill'); ?>',
            type: 'POST',
            data: {
                daftarpegawai: daftarpegawai,
                instruksi: instruksi
            },
            success: function(response) {
                console.log(response.daftarpegawai);
                console.log(response.instruksi);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
        location.reload();
    });
</script>

<?= $this->endSection(); ?>
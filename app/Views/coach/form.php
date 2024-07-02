<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between">
    <h3><?= $data ? 'Update coach' : 'Create coach' ?></h3>

    <a href="<?= site_url('coach') ?>" class="btn btn-primary">See all coaches</a>
</div>

<div class="alert d-none" id="response" role="alert">
</div>

<form class="row" method="post" enctype="multipart/form-data" id="form-coach">
    <div class="col-12 form-group mb-3">
        <label for="coach-name">Name</label>
        <input type="text" id="coach-name" name="name" class="form-control" placeholder="Write the coach name" required value="<?= $data ? $data['name'] : '' ?>">
    </div>

    <?php if ($data) : ?>
        <div class="col-md-4 form-group mb-3">
            <img src="<?= base_url('/uploads/coaches/') . ($data['image'] == null || $data['image'] == '' ? 'default.png' : $data['image']) ?>" style="width: 100px; object-fit:cover;height: 100px">
        </div>
        <input type="hidden" value="<?= $data['id'] ?>" name="id">
        <input type="hidden" value="<?= $data['image'] ?>" name="image_name">
    <?php endif ?>

    <div class="col-12 form-group mb-3">
        <label for="coach-image">Foto <small>(.jpg, .png)</small></label>
        <input type="file" name="image" id="coach-image" class="form-control">
    </div>

    <div class="col-12 form-group mb-3">
        <label for="coach-country">Team</label>
        <select name="team_id" id="coach-country" class="form-control" required>
            <?php if ($data) : ?>
                <option value="<?= $data['team_id'] ?>"><?= $data['team'] ?></option>
            <?php endif ?>
        </select>
    </div>

    <div class="col-3 mb-3">
        <button type="submit" id="btn-submit" class="btn btn-primary me-3">
            <span class="btn-submit-description">
                <?php if ($data) : ?>
                    <i class="iconsax me-1" icon-name="refresh"></i> Update
                <?php else : ?>
                    <i class="iconsax me-1" icon-name="document-1"></i> Create
                <?php endif ?>
            </span>
            <div class="spinner-border spinner-submit text-light d-none" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </button>

        <?php if ($data) : ?>
            <button data-id="<?= $data['id'] ?>" class="btn btn-danger btn-delete">
                <i class="iconsax me-1" icon-name="trash"></i> Eliminar
            </button>
        <?php endif ?>
    </div>
</form>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(() => {
        fetch_country();

        const form = $('#form-coach');
        $('#btn-submit').click(function(event) {
            event.preventDefault();

            $(".spinner-submit").removeClass('d-none');
            $(".btn-submit-description").addClass('d-none');

            var formData = new FormData(form[0]);

            $.ajax({
                url: "<?= site_url('api/v1/coach') ?>",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#response').addClass('alert-success')
                    $('#response').removeClass('d-none')
                    $('#response').html('<span>' + response.message + '</span>');

                    form[0].reset();
                    console.log(response)
                },
                error: function(xhr, status, error) {
                    $('#response').addClass('alert-danger')
                    $('#response').removeClass('d-none')
                    $('#response').html('<span>Ocorreu um erro: ' + error + '</span>');
                }
            });

            $(".spinner-submit").addClass('d-none');
            $(".btn-submit-description").removeClass('d-none');
        });

        $('.btn-delete').click(() => {
            const id = $('.btn-delete').data('id');
            $.ajax({
                url: "<?= site_url('api/v1/coach/') ?>" + id + '/delete',
                type: 'GET',
                success: function(response) {
                    $('#response').addClass('alert-success')
                    $('#response').removeClass('d-none')
                    $('#response').html('<span>' + response.message + '</span>');

                    document.location.href = "<?= site_url('coach') ?>"
                },
                error: function(xhr, status, error) {
                    $('#response').addClass('alert-danger')
                    $('#response').removeClass('d-none')
                    $('#response').html('<span>Ocorreu um erro: ' + error + '</span>');
                }
            });
        });
    });

    function fetch_country() {
        $.ajax({
            url: "<?= site_url('api/v1/team') ?>",
            type: 'GET',
            success: function(response) {
                data = response.data;
                if (data.length == 0) {
                    $('#coach-country').attr('disabled', true);
                } else {
                    data.map(team => {
                        const emblem = team.emblem == null || team.emblem == '' ? 'default.png' : team.emblem;
                        const el = $(`
                            <option value="${team.id}">
                                ${team.name}
                            </option>
                        `);
                        $('#coach-country').append(el);
                    });
                }
            },
            error: function(xhr, status, error) {
                $('#coach-country').attr('disabled', true);
            }
        });
    }
</script>
<?= $this->endSection() ?>
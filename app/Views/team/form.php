<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between">
    <h3><?= $data ? 'Update team' : 'Create team' ?></h3>

    <a href="<?= site_url('team') ?>" class="btn btn-primary">See all teams</a>
</div>

<div class="alert d-none" id="response" role="alert">
</div>
<form class="row" id="form-team" enctype="multipart/form-data">
    <div class="col-12 form-group mb-3">
        <label for="team-name">Team</label>
        <input type="text" id="team-name" name="name" autocomplete="false" class="form-control" placeholder="Write the team name" required value="<?= $data ? $data['name'] : '' ?>">
    </div>

    <div class="col-12 form-group mb-3">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" rows="3"><?= $data ? $data['description'] : '' ?></textarea>
    </div>

    <?php if ($data) : ?>
        <div class="col-md-4 form-group mb-3">
            <img src="<?= base_url('/uploads/emblem/') . ($data['emblem'] == null || $data['emblem'] == '' ? 'default.png' : $data['emblem']) ?>" style="width: 100px; object-fit:cover;height: 100px">
        </div>
        <input type="hidden" value="<?= $data['id'] ?>" name="id">
        <input type="hidden" value="<?= $data['emblem'] ?>" name="image_name">
    <?php endif ?>

    <div class="col-12 form-group mb-3">
        <label for="team-emblem">Emblem <small>(.jpg, .png)</small></label>
        <input type="file" name="image" id="team-emblem" class="form-control" value="<?= $data ? $data['emblem'] : '' ?>">
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
        const form = $('#form-team');
        $('#btn-submit').click(function(event) {
            event.preventDefault();

            $(".spinner-submit").removeClass('d-none');
            $(".btn-submit-description").addClass('d-none');

            var formData = new FormData(form[0]);

            $.ajax({
                url: "<?= site_url('api/v1/team') ?>",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#response').addClass('alert-success')
                    $('#response').removeClass('d-none')
                    $('#response').html('<span>' + response.message + '</span>');

                    form[0].reset();
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
                url: "<?= site_url('api/v1/team/') ?>" + id + '/delete',
                type: 'GET',
                success: function(response) {
                    $('#response').addClass('alert-success')
                    $('#response').removeClass('d-none')
                    $('#response').html('<span>' + response.message + '</span>');

                    document.location.href = "<?= site_url('team') ?>"
                },
                error: function(xhr, status, error) {
                    $('#response').addClass('alert-danger')
                    $('#response').removeClass('d-none')
                    $('#response').html('<span>Ocorreu um erro: ' + error + '</span>');
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>
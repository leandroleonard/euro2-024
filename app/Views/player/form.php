<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between">
    <h3><?= $data ? 'Update player' : 'Create player' ?></h3>

    <a href="<?= site_url('player') ?>" class="btn btn-primary">See all players</a>
</div>

<div class="alert d-none" id="response" role="alert">
</div>

<form class="row" method="post" enctype="multipart/form-data" id="form-player">
    <div class="col-12 form-group mb-3">
        <label for="player-name">Name</label>
        <input type="text" id="player-name" name="name" class="form-control" placeholder="Write the player name" required value="<?= $data ? $data['name'] : '' ?>">
    </div>

    <div class="col-12 form-group mb-3">
        <label for="player-position">Position</label>
        <select name="position" id="player-position" class="form-control" required>
            <?php if ($data) : ?>
                <option><?= $data['position'] ?></option>
            <?php endif ?>
            <option>GK</option>
            <option>LB</option>
            <option>RB</option>
        </select>
    </div>

    <div class="col-12 form-group mb-3">
        <label for="birthday">Birthday</label>
        <input type="date" name="birthday" id="birthday" class="form-control" required value="<?= $data ? $data['birthday'] : '' ?>" />
    </div>

    <?php if ($data) : ?>
        <div class="col-md-4 form-group mb-3">
            <img src="<?= base_url('/uploads/players/') . ($data['image'] == null || $data['image'] == '' ? 'default.png' : $data['image']) ?>" style="width: 100px; object-fit:cover;height: 100px">
        </div>
        <input type="hidden" value="<?= $data['id'] ?>" name="id">
        <input type="hidden" value="<?= $data['image'] ?>" name="image_name">
    <?php endif ?>

    <div class="col-12 form-group mb-3">
        <label for="player-image">Foto <small>(.jpg, .png)</small></label>
        <input type="file" name="image" id="player-image" class="form-control">
    </div>

    <div class="col-12 form-group mb-3">
        <label for="player-country">Team</label>
        <select name="team_id" id="player-country" class="form-control" required>
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

        const form = $('#form-player');
        $('#btn-submit').click(function(event) {
            event.preventDefault();

            $(".spinner-submit").removeClass('d-none');
            $(".btn-submit-description").addClass('d-none');

            var formData = new FormData(form[0]);

            $.ajax({
                url: "<?= site_url('api/v1/player') ?>",
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
                url: "<?= site_url('api/v1/player/') ?>" + id + '/delete',
                type: 'GET',
                success: function(response) {
                    $('#response').addClass('alert-success')
                    $('#response').removeClass('d-none')
                    $('#response').html('<span>' + response.message + '</span>');

                    document.location.href = "<?= site_url('player') ?>"
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
                    $('#player-country').attr('disabled', true);
                } else {
                    data.map(team => {
                        const emblem = team.emblem == null || team.emblem == '' ? 'default.png' : team.emblem;
                        const el = $(`
                            <option value="${team.id}">
                                ${team.name}
                            </option>
                        `);
                        $('#player-country').append(el);
                    });
                }
            },
            error: function(xhr, status, error) {
                $('#player-country').attr('disabled', true);
            }
        });
    }
</script>
<?= $this->endSection() ?>
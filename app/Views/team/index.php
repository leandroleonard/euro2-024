<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between">
    <h3>All Team</h3>

    <a href="<?= site_url('team/create') ?>" class="btn btn-primary">Create</a>
</div>
<p id="response"></p>

<div class="table">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Team</th>
                <th>Description</th>
                <th>OP</th>
            </tr>
        </thead>
        <tbody id="table-body-team">

        </tbody>
    </table>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    $(document).ready(() => {
        fetch_data();
    });

    function fetch_data() {
        $.ajax({
            url: "<?= site_url('api/v1/team') ?>",
            type: 'GET',
            success: function(response) {
                data = response.data;
                if (data.length == 0) {
                    const el = $(`
                        <tr><td>There is no teams</td><tr>
                    `);
                    $('#table-body-team').append(el);

                } else {
                    data.map(team => {
                        const emblem = team.emblem == null || team.emblem == '' ? 'default.png' : team.emblem;
                        const el = $(`
                            <tr>
                                <td>${team.id}</td>
                                <td>
                                    <img class="team-emblem" src="${"<?= base_url('uploads/emblem/') ?>" + emblem}" />
                                    ${team.name}
                                </td>
                                <td>${team.description}</td>
                                <td>
                                    <a href="<?= site_url('team/') ?>${team.id}" class="me-2 text-primary"><i class="iconsax" icon-name="edit-1"></i></a>
                                </td>
                            <tr>
                        `);
                        $('#table-body-team').append(el);
                    });
                }


            },
            error: function(xhr, status, error) {
                $('#response').html(error);
            }
        });
    }
</script>
<?= $this->endSection() ?>
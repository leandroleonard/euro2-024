<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between">
    <h3>All coaches</h3>

    <a href="<?= site_url('coach/create') ?>" class="btn btn-primary">Create</a>
</div>
<p id="response"></p>

<div class="table">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>coach</th>
                <th>OP</th>
            </tr>
        </thead>
        <tbody id="table-body-coach">

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
            url: "<?= site_url('api/v1/coach') ?>",
            type: 'GET',
            success: function(response) {
                data = response.data;
                console.log(response)
                if (data.length == 0) {
                    const el = $(`
                        <tr><td>There is no coachs</td><tr>
                    `);
                    $('#table-body-coach').append(el);

                } else {
                    data.map(coach => {
                        const image = coach.image == null || coach.image == '' ? 'default.png' : coach.image;
                        const el = $(`
                            <tr>
                                <td>${coach.id}</td>
                                <td>
                                    <img class="coach-image" src="${"<?= base_url('uploads/coaches/') ?>" + image}" />
                                    ${coach.name}
                                </td>
                                <td>${coach.team}</td>
                                <td>
                                    <a href="<?= site_url('coach/') ?>${coach.id}" class="me-2 text-primary"><i class="iconsax" icon-name="edit-1"></i></a>
                                </td>
                            <tr>
                        `);
                        $('#table-body-coach').append(el);
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
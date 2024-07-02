<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between">
    <h3>All Groups</h3>
</div>

<p id="response"></p>

<div id="groups-content">

</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(() => {
        fetch_data();
    });

    function fetch_data() {
        $.ajax({
            url: "<?= site_url('api/v1/groups') ?>",
            type: 'GET',
            success: function(response) {
                console.log(response)
                data = response.data;
                if (data.length == 0) {
                    const el = $(`
                        <h1>There is no image</h1>
                    `);
                    $('#groups-content').append(el);

                } else {
                    data.map(group => {
                        const el = $(`
                            <table class="table table-striped mb-5">
                                <thead>
                                    <tr class="text-center bg-warning text-white">
                                        <th colspan="7">Group ${group.Group}</th>
                                    </tr>
                                    <tr>
                                        <th>Team</th>
                                        <th>P</th>
                                        <th>G</th>
                                        <th>W</th>
                                        <th>D</th>
                                        <th>L</th>
                                        <th>G+</th>
                                    </tr>
                                </thead>
                                <tbody id="teams-group-${group.Group}">
                                    
                                </tbody>
                            </table>
                        `);
                        $('#groups-content').append(el);

                        for(i = 0;i < 4;i++){
                            const teamEl = $(`
                                <tr>
                                    <td>
                                        <img class="team-emblem" src="${"<?= base_url('uploads/emblem/') ?>" + group.images[i]}" />
                                        ${group.teams[i]}
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td><td>0</td><td>0</td>
                                </tr>
                            `);

                            $(`#teams-group-${group.Group}`).append(teamEl);
                        }
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
<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

    <h3>Create Region</h3>

    <form action="" class="row">
        <div class="col-12 form-group mb-3">
            <label for="region">Region</label>
            <input type="text" class="form-control" placeholder="Write the region name" required>
        </div>

        <div class="col-3 mb-3">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>

<?= $this->endSection() ?>
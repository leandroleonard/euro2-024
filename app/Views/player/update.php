<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

    <h3>Update Player Info</h3>

    <form action="" class="row">
        <div class="col-12 form-group mb-3">
            <label for="player-name">Name</label>
            <input type="text" id="player-name" name="name" class="form-control" placeholder="Write the player name" required>
        </div>

        <div class="col-12 form-group mb-3">
            <label for="player-position">Position</label>
            <select name="position" id="player-position" class="form-control" required>
                <option>GK</option>
                <option>LB</option>
                <option>RB</option>
            </select>
        </div>

        <div class="col-12 form-group mb-3">
            <label for="birthday">Birthday</label>
            <input type="date" name="birthday" id="birthday" class="form-control"/>
        </div>

        <div class="col-12 form-group mb-3">
            <label for="player-image">Avatar <small>(.jpg, .png)</small></label>
            <input type="file" name="image" id="player-image" class="form-control">
        </div>

        <div class="col-12 form-group mb-3">
            <label for="player-country">Team</label>
            <select name="country" id="player-country" class="form-control" required>
                <option>Angola</option>
            </select>
        </div>

        <input type="hidden" name="id">

        <div class="col-3 mb-3">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>

<?= $this->endSection() ?>
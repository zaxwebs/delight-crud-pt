<?php

require_once('d-core/load.php');
loadCore('cycle.php');
cycleStart();

loadCore('page.php');
loadCore('db.php');
loadCustom('extra.php');
putHeader();
?>
<section>
    <div class="container">
        <div data-aos="fade-up" class="row flex-column-reverse flex-md-row">
            <div class="col-md-5 d-flex align-items-center mb-3">
                <div>
                    <h2>DeLight People Tracker</h2>
                    <p class="pb-4 grey">
                        A <span class="badge badge-primary rounded">demo</span> CRUD application made with <a href="https://github.com/zaxwebs/DeLight">DeLight</a>. This application lets you <a href="add-person.php">add people</a> that are of interest to you and make notes about them.
                    </p>
                    <a class="btn btn-primary mb-2" href="/add-person.php">Add A Person</a>
                </div>
            </div>
            <div data-aos="fade-left" class="col-md-7 d-flex align-items-center mb-3">
                <img class="img-fluid" src="assets/images/cover.svg">
            </div>
        </div>
    </div>
</section>
<section id="people">
    <div class="container">
        <?php

        $people_count = fetchColumn('select count(*) from people');

        if ($people_count === 0) {
            echo '<h3 class="text-center text-black-50"><a href="add-person.php">Add people</a> to start adding notes about them.</h3>';
        } else {
            $people = fetchAll('select * from people');
            ?>
            <h2>People You Added</h2>
            <div class="row">
                <?php
                    foreach ($people as $person) {
                        ?>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlentities($person['name']) ?></h5>
                                <p class="card-text grey"><?= htmlentities(excerptify($person['intro'], 40)) ?></p>
                                <a href="/person.php?id=<?= $person['id'] ?>" class="btn btn-primary">Explore Notes</a>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                    ?>
            </div>
        <?php
        }

        ?>

    </div>
</section>
<?php
putFooter();
cycleEnd();

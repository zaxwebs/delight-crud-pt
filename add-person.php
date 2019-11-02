<?php

require_once('d-core/load.php');
loadCore('cycle.php');
cycleStart();

loadCore('page.php');

putHeader();
?>
<section>
    <div class="container">
        <div data-aos="fade-up" data-aos-anchor-placement="top-bottom" class="row">
            <div data-aos="fade-right" data-aos-anchor-placement="center-bottom" class="col-md-6 d-flex align-items-center mb-3">
                <img class="img-fluid" src="assets/images/2.svg">
            </div>
            <div class="col-md-6 d-flex align-items-center mb-3">
                <div class="w-100">
                    <h2>Add A Person</h2>
                    <p class="pb-4 grey">
                        Fill in the details below to add a person. You will then be able to add notes about them and thus track their development & your association or friendship.
                    </p>
                    <form method="post" action="d-processors/add-person.php">
                        <div class="form-group">
                            <label>Name</label><span class="text-primary">*</span>
                            <input type="text" class="form-control" name="name" autocomplete="off" value="<?= echoFlash('name') ?>" placeholder="Zack Webster">
                        </div>
                        <div class="form-group">
                            <label>A little info about this person</label>
                            <textarea class="form-control" name="intro" rows="4" placeholder="He's a web developer and designer."></textarea>
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary">Add Person</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
putFooter();
cycleEnd();

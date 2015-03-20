<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Playing with Selectize.js</title>

	<link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/selectize.js/dist/css/selectize.css">
	<style>
		.awesome-divider {
            margin-top: 30px;
            margin-bottom: 40px;
            position: relative;
        }

        .awesome-divider:after {
            content: ' ';
            top: 30px;
            left: 0;
            width: 100%;
            position: absolute;
            height: 4px;
            background-color: #faebcc;
        }

        .awesome-divider span {
            color: #8a6d3b;
            position: relative;
            z-index: 1;
            display: block;
            width: 60px;
            height: 60px;
            background-color: #fcf8e3;
            border-radius: 50%;
            text-align: center;
            line-height: 57px;
            text-transform: uppercase;
            margin-left: auto;
            margin-right: auto;
            border: 3px #FFFFFF solid;
        }
	</style>

	<script src="assets/jquery/dist/jquery.min.js"></script>
	<script src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="assets/selectize.js/dist/js/standalone/selectize.js"></script>
	<script src="main.js"></script>

</head>
<body>

<?php

$locationCsv = array_map('str_getcsv', file('data/location.csv'));

unset($locationCsv[0]);

$locationData = [];
$locationAll = [];

foreach ($locationCsv as $loc) {
	$locationData[$loc[1]]['name'] = $loc[0];
	$locationData[$loc[1]]['slug'] = $loc[1];

	if (@$loc[3]) {
		$locationData[$loc[1]]['district'][$loc[3]]['name'] = $loc[2];
		$locationData[$loc[1]]['district'][$loc[3]]['slug'] = $loc[3];
	}
}

foreach ($locationCsv as $loc) {
    $locationAll[$loc[3]]['name'] = $loc[2];
    $locationAll[$loc[3]]['slug'] = $loc[3];

	if (@$loc[1]) {
        $locationAll[$loc[3]]['state']['name'] = $loc[0];
        $locationAll[$loc[3]]['state']['slug'] = $loc[1];
	}
}

$output = $locationData;

?>

<div class="container" style="margin-top: 100px;">
	<div class="row">
		<div class="col-md-offset-4 col-md-4">
			<form>

                <div class="alert alert-warning">
                    <p>Type in your location, state or district.</p>
                </div><!-- .alert -->

                <div class="form-group">
                    <label for="state">Location</label>
                    <select name="location" id="location" class="js-selectize js-selectize-state js-selectize--state" placeholder="Location">
                        <option>State</option>
                        <?php foreach ($locationAll as $loc) { ?>
                            <option value="<?= $loc['slug'] ?>"><?= $loc['state']['name'] ?>, <?= $loc['name'] ?></option>
                        <?php } ?>
                    </select>
                </div><!-- .form-group -->

                <div class="awesome-divider"><span>or</span></div>

                <div class="alert alert-warning">
                    <p>Or, select your location state first, then select district.</p>
                </div><!-- .alert -->

				<div class="form-group">
					<label for="state">State</label>
					<select name="state" id="state" class="js-selectize js-selectize-state js-selectize--state" placeholder="State">
						<option>State</option>
						<?php foreach ($output as $state) { ?>
							<option value="<?= $state['slug'] ?>"><?= $state['name'] ?></option>
						<?php } ?>
					</select>
				</div><!-- .form-group -->

				<div class="form-group">
					<label for="district">District</label>
					<select class="js-selectize js-selectize-district js-selectize--district" name="district" id="district" placeholder="District">
						<option>District</option>
					</select>
				</div><!-- .form-group -->
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container -->

</body>
</html>
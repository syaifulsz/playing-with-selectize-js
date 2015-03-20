$(document).ready(function() {

	var selectState, $selectState;
	var selectDistrict, $selectDistrict;
    var $selectLocation;

	var $selectState = $('#state').selectize({
    	onChange: function(value) {

    		if (value) {
				$.ajax('data.php').success(function(data) {
					var district = data[value].district;
					if (district) {
						var districtOptions = [];
						$.each(district, function(key, data) {
							districtOptions.push({ name: data.name, value: data.slug })
						});

						selectDistrict.enable();
						selectDistrict.clearOptions();
						selectDistrict.load(function(callback) {
							callback(districtOptions);
						});
					} else {
						selectDistrict.disable();
						selectDistrict.clearOptions();
					}
				});
    		}
		}
	});

	var $selectDistrict = $('#district').selectize({
	    valueField: 'name',
	    labelField: 'name',
	    searchField: ['name']
	});

	selectState  = $selectState[0].selectize;
	selectDistrict = $selectDistrict[0].selectize;
	selectDistrict.disable();

    var $selectLocation = $('#location').selectize({
        valueField: 'name',
        labelField: 'name',
        searchField: ['name']
    });
});
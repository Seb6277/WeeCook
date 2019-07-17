const $ = require('jquery');

$('input#edit_recipe_image1').on("change", function () {
    const file = $('#edit_recipe_image1')[0].files[0].name;
    $('input#edit_recipe_image1').attr('placeholder', file)
});
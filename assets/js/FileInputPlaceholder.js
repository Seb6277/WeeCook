/*
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

const $ = require('jquery');

$('input#edit_recipe_image1').on("change", function () {
    const file = $('#edit_recipe_image1')[0].files[0].name;
    $('input#edit_recipe_image1').attr('placeholder', file)
});
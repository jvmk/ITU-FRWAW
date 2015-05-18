/**
 * Scripts specific to index.html.
 */

$(document).ready(function(e) {
    // declare dependency on other script
    var script = 'scripts/flickr.js';
    $("head").append('<script type="text/javascript" src="' + script + '"></script>');
});

var photoPagesRequested = 1;

$(document).on('submit', '#formSearchFlickr', function(e) {
    // Block regular form submit that causes a page reload.
    e.preventDefault();
    // fetch the search term.
    var searchTerm = $('#inputSearchTerm').val();
    searchFlickr(searchTerm, 10, photoPagesRequested, function(data) {
        // Create a new element to display every image.
        $.each(data.photos.photo, function(i, photo) {
            // Build the URL for the image.
            var $imgUrl = 'http://farm' + photo.farm + '.staticflickr.com/' + photo.server + '/' + photo.id + '_' + photo.secret + '_n.jpg';
            var $image = $('<img/>', { src: $imgUrl });
            var $back = $('<div/>', { class: 'back', text: 'This is the back of the image.' });
            // Create flipping image.
            var $flipper = createFlipper($image, $back);
            // TODO settle on background.
            $back.parent().css('background-color', 'red');
            // Image height and width is first available when image has loaded.
            $image.load(function(e) {
                // Set width and height of container based on size of image.
                $flipper.css('width', $(this).width());
                $flipper.css('height', $(this).height());
            });
            $('#search-results-container').append($flipper);

        });
    });
    photoPagesRequested++;
});

/**
 * Constructs an element that is flipped to display its back when hovered.
 * Note that the returned element relies on the CSS3 defined in flipper.css.
 * @param $frontContents The contents to display when not hovering the element.
 * @param $backContents The contents to display when hovering the element.
 * @returns {*|jQuery|HTMLElement} The 'flipper' element.
 */
function createFlipper($frontContents, $backContents) {
    var $flipperContainer = $('<div/>', { class: 'flipper-container'});
    var $flipper = $('<div/>', { class: 'flipper'});
    var $flipperFront = $('<div/>', { class: 'flipper-front'});
    var $flipperBack = $('<div/>', { class: 'flipper-back'});

    $flipperFront.append($frontContents);
    $flipperBack.append($backContents);

    $flipper.append($flipperFront);
    $flipper.append($flipperBack);

    $flipperContainer.append($flipper);

    return $flipperContainer;
}
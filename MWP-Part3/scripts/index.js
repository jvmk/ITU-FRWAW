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
        // Create a new element to display each image.
        $.each(data.photos.photo, function(i, photo) {
            // Build the URL for the image.
            var $imgUrl = 'http://farm' + photo.farm + '.staticflickr.com/' + photo.server + '/' + photo.id + '_' + photo.secret + '_n.jpg';
            var $front = $('<div/>');
            var $image = $('<img/>', { src: $imgUrl });
            var $back = $('<div/>');
            var $btnLocation = $('<input/>', { type: 'image', src: 'images/location-icon.png', class: 'btn-flip', alt: 'Photo Location.'});
            var $btnImage = $('<input/>', { type: 'image', src: 'images/flip-icon.png', class: 'btn-flip', alt: 'Photo.'});

            // Flip image when location button is clicked.
            $btnLocation.on('click', function(e) {
                e.preventDefault();
                $(this).parents('.flipper').addClass('flipped');
            });
            // Flip from map to image when flip button is clicked.
            $btnImage.on('click', function(e) {
                e.preventDefault();
                $(this).parents('.flipper').removeClass('flipped');
            });

            $back.css('overflow', 'hidden');
            $back.append($btnImage);

            // Create flipping image.
            $front.append($image);
            $front.append($btnLocation);
            var $flipper = createFlipper($front, $back);

            //$btnLocation.one('load', function(e) {
            //    // recompute height of container when image button loads.
            //    $flipper.height($front.outerHeight(true));
            //});

            // Add element to DOM.
            var $resultContainer = $('<div/>', { class: 'search-result' });
            $('#search-results-container').append($resultContainer.append($flipper));
            // Image height and width is first available when image has loaded.
            $image.one('load', function(e) {
                // Update size of container to fit contents...
                $flipper.height($front.outerHeight(true));
                // Width is constrained by the width of the flickr image.
                // For some reason $front.outerWidth(true) does not take the actual width of the image into account.
                // Hence we must manually compute the width and add margins like so:
                var $w = $(this).width() + $front.outerWidth(true) - $front.outerWidth();
                $flipper.css('width', $w);

                // Set size of map to match that of the image on the front.
                //$back.css('width', $(this).width());
                //$back.css('height', $(this).height());
                var $imgWidth = $(this).width();
                var $imgHeight = $(this).height();


                // AJAX call: get location data and create a map to show where photo was shot.
                getPhotoLocation(photo.id, function(response) {
                    if (response.stat === 'ok') {
                        // Location data available.
                        // Create map element and append to back element.
                        var latLng = new google.maps.LatLng(parseFloat(response.photo.location.latitude), parseFloat(response.photo.location.longitude));
                        var mapOptions = {
                            center: latLng,
                            zoom: 10
                        };
                        var $mapDiv = $('<div/>');
                        $mapDiv.width($imgWidth);
                        $mapDiv.height($imgHeight);
                        var map = new google.maps.Map($mapDiv[0], mapOptions);
                        // Set a marker to display exact photo location.
                        var marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            title: 'Photo location.'
                        });
                        $back.prepend($mapDiv);
                    } else {
                        // Simplified error handling.
                        var $errMsg = $('<p>No location data available Q_Q</p>');
                        $back.prepend($errMsg);
                        $errMsg.width($imgWidth);
                        $errMsg.height($imgHeight);
                        $errMsg.css('margin', '0');
                        $back.css('color', 'white');
                    }
                });
            });
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

function computeHeight($parent) {
    var $result = 0;
    // sum width of children
    $parent.children().each(function () {
        $result += $(this).outerHeight(true);
    });
    // add parent margin
    $result += $parent.outerHeight(true) - $parent.outerHeight();
    return $result;
}
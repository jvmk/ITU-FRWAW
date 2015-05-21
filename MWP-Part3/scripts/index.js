/**
 * Scripts specific to index.html.
 */

$(document).ready(function(e) {
    // declare dependency on other script
    var script = 'scripts/flickr.js';
    $("head").append('<script type="text/javascript" src="' + script + '"></script>');

    // Allow drop on the bulletin board by preventing default behavior.
    $('#bulletin').on('dragover', function(e) {
        e.preventDefault();
    });

    // Move element to where it is dropped.
    $('#bulletin').on('drop', function(e) {
        e.preventDefault();
        var $elementId = e.originalEvent.dataTransfer.getData('text');
        e.originalEvent.target.appendChild(document.getElementById($elementId));
        var $flipper = $('#' + $elementId);
        // Insert a push-pin.
        addPushpin($flipper, $elementId);

        // Add a random rotation to the picture when posted on the cork board.
        var $rotation = getRandomInt(-3, 4);
        $flipper.css('transform', 'rotate(' + $rotation + 'deg)');

        // Store the photo element in local storage.
        var $photoUrl = $('#' + $elementId + ' img').attr('src');
        var $rotation = $('#' + $elementId).css('transform');
        savePhoto($elementId, $photoUrl, $rotation);
    });
    //localStorage.clear();
    // Load photos from local storage onto the cork board.
    initCorkBoard();

    // Asign handlers for navigation buttons.
    $('#previous-search-results').on('click', function(ev) {
        if (photoPagesRequested === 1) {
            // At first page, do nothing.
        } else {
            // First, clear photos for current page.
            $('#search-results-container').empty();
            // Go back one page...
            photoPagesRequested--;
            searchFlickr(searchTerm, photosPerPage, photoPagesRequested, function(data) {
                handleFlickrSearchResult(data);
            });
        }
    });
    $('#next-search-results').on('click', function(ev) {
        // First, clear photos for current page.
        $('#search-results-container').empty();
        photoPagesRequested++;
        searchFlickr(searchTerm, photosPerPage, photoPagesRequested, function(data) {
            handleFlickrSearchResult(data);
        });
    });
});

var photosPerPage = 12;
var photoPagesRequested = 1;
var searchTerm = '';

function handleFlickrSearchResult(data) {
    // Create a new element to display each image.
    $.each(data.photos.photo, function(i, photo) {
        // Build the URL for the image.
        var $imgUrl = 'http://farm' + photo.farm + '.staticflickr.com/' + photo.server + '/' + photo.id + '_' + photo.secret + '_m.jpg';
        // Create a container and append it to the DOM.
        var $resultContainer = $('<div/>', { class: 'search-result' });
        $('#search-results-container').append($resultContainer);
        // Create the image element and append it to the container element.
        createPhotoElement($resultContainer, $imgUrl, photo.id);
    });
}

$(document).on('submit', '#formSearchFlickr', function(e) {
    // Block regular form submit that causes a page reload.
    e.preventDefault();
    // Clear previous results.
    $('#search-results-container').empty();
    photoPagesRequested = 1;
    // fetch the search term.
    searchTerm = $('#inputSearchTerm').val();
    searchFlickr(searchTerm, photosPerPage, photoPagesRequested, function(data) {
        // Create a new element to display each image.
        $.each(data.photos.photo, function(i, photo) {
            // Build the URL for the image.
            var $imgUrl = 'http://farm' + photo.farm + '.staticflickr.com/' + photo.server + '/' + photo.id + '_' + photo.secret + '_m.jpg';
            // Create a container and append it to the DOM.
            var $resultContainer = $('<div/>', { class: 'search-result' });
            $('#search-results-container').append($resultContainer);
            // Create the image element and append it to the container element.
            createPhotoElement($resultContainer, $imgUrl, photo.id);
        });
    });
});

/**
 * Creates a photo element and appends it to $parentElem, i.e. the created element is not returned.
 * @param $parentElem The parent element that the photo is to be appended to.
 * @param $photoUrl The URL of the flickr photo.
 * @param $flickrPhotoId The flickr ID of the photo.
 */
function createPhotoElement($parentElem, $photoUrl, $flickrPhotoId) {
    var $front = $('<div/>');
    var $image = $('<img/>', { src: $photoUrl });
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
    // Add an ID (for drag and drop)
    $flipper.attr('id', $flickrPhotoId);
    // Set draggable
    $flipper.attr('draggable', 'true');
    // Set what is dragged
    $flipper.on('dragstart', function(e) {
        // Keep reference to ID of dragged element.
        e.originalEvent.dataTransfer.setData('text', $(this).attr('id'));
    });

    // Add element to DOM.
    $parentElem.append($flipper);
    // Image height and width is first available when image has loaded.
    $image.one('load', function(e) {
        // Update size of container to fit contents...
        $flipper.height($front.outerHeight(true));
        // Width is constrained by the width of the flickr image.
        // For some reason $front.outerWidth(true) does not take the actual width of the image into account.
        // Hence we must manually compute the width and add margins like so:
        var $w = $(this).width() + $front.outerWidth(true) - $front.outerWidth();
        $flipper.css('width', $w);

        var $imgWidth = $(this).width();
        var $imgHeight = $(this).height();

        // AJAX call: get location data and create a map to show where photo was shot.
        getPhotoLocation($flickrPhotoId, function(response) {
            if (response.stat === 'ok') {
                // Location data available.
                // Create map element and append to back element.
                var latLng = new google.maps.LatLng(parseFloat(response.photo.location.latitude), parseFloat(response.photo.location.longitude));
                var mapOptions = {
                    center: latLng,
                    zoom: 10
                };
                var $mapDiv = $('<div/>');
                // Set size of map to match that of the image on the front.
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
}

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

/**
 * Adds a push-pin to a photo element (and also adds event handlers).
 * @param $photo The photo to which the push-pin is tied.
 * @param $photoId The ID of the element that is to be removed from the DOM and local storage when the push-pin is clicked.
 */
function addPushpin($photo, $photoId) {
    // Insert a push-pin.
    var $pushPin = $('<div/>', { class: 'push-pin' });
    $pushPin.insertBefore($photo);

    // assign event handler for push-pin click
    $pushPin.on('click', function(e) {
        // Apply fade-out effect to indicate that the push-pin is removed.
        $pushPin.addClass('fadeout');
    });

    // Delay removal of photo element till the animation has ended.
    var $animationEndHandler = function (e) {
        // Remove self (i.e. the push-pin) from DOM.
        $(this).remove();

        // Remove photo from DOM after playing an animation that simulates the image falling.
        var $photoAnimationEndHandler = function (e) {
            $(this).remove();
            // Remove from local storage
            deletePhoto($photoId);
        };
        $photo.on('webkitAnimationEnd', $photoAnimationEndHandler);
        $photo.on('animationend', $photoAnimationEndHandler);
        $photo.addClass('falling');

    };
    // Assign the event handler to the push-pin (Chrome)
    $pushPin.on('webkitAnimationEnd', $animationEndHandler);
    // Assign the event handler to the push-pin (General)
    $pushPin.on('animationend', $animationEndHandler);
}

/**
 * Stores the URL of a flickr photo in local storage.
 * @param $photoUrl The URL of the flickr photo.
 */
function savePhoto(photoId, $photoUrl, $rotation) {
    console.log('savePhoto called with ID='+photoId+' URL='+$photoUrl+' ROTATION='+$rotation);
    // Check if local storage is supported.
    if(typeof(Storage) !== "undefined") {
        // The photo is stored as an object wrapped in an array.
        // The array contains all photos stored locally.
        // The array is ordered in ascending order (i.e. elements most recently added are at the end of the array).
        var photoArr;
        if(localStorage.photos) {
            // Array already exists, get it.
            photoArr = JSON.parse(localStorage.photos);
        } else {
            // No array found, create it.
            photoArr = [];
        }
        // Add this photo to the array.
        var obj = { id: photoId, url: $photoUrl, rotation: $rotation };
        photoArr.push(obj);
        // Overwrite the array in local storage.
        localStorage.photos = JSON.stringify(photoArr);
    } else {
        alert('Sorry, browser does not support locally storing photos.');
    }
}

/**
 * Deletes a photo from local storage.
 * @param $photoId ID of the photo that is to be deleted from local storage.
 */
function deletePhoto($photoId) {
    if(typeof(Storage) !== "undefined" && localStorage.photos) {
        var photoArr = JSON.parse(localStorage.photos);
        var index = -1;
        // Search the photo array for the photo we are to delete.
        for (var i = 0; i < photoArr.length; i++) {
            if (photoArr[i].id === $photoId) {
                // found the matching photo, log index.
                index = i;
                break;
            }
        }
        if (index > -1) {
            // Remove the photo from the array.
            photoArr.splice(index, 1);
            // Overwrite the local storage array with the resulting array.
            localStorage.photos = JSON.stringify(photoArr);
        }
    }
}

/**
 * Fills the cork board with photos based on locally stored photo IDs.
 */
function initCorkBoard() {
    if(typeof(Storage) !== "undefined") {

        if(localStorage.photos) {
            // If there is an array with photos stored locally, get it.
            var photoArr = JSON.parse(localStorage.photos);
            for(var i = 0; i < photoArr.length; i++) {
                // add a photo element on the cork board for each photo in the array
                var photoData = photoArr[i];
                console.log('Found photo: ' + JSON.stringify(photoData));
                createPhotoElement($('#bulletin'), photoData.url, photoData.id);
                // apply saved rotation
                $('#' + photoData.id).css('transform', photoData.rotation);
                // add the push-pin
                addPushpin($('#' + photoData.id), photoData.id);
            }
        }

        //// Create a photo element for every key found.
        ////for(var key in localStorage) {
        //for (var i = 0; i < localStorage.length; i++) {
        //    var key = localStorage.key(i);
        //    //console.log(key + ': ' + localStorage.getItem(key));
        //    // recreate element on cork-board
        //    var value = localStorage.getItem(key);
        //    var photoData = JSON.parse(value);
        //    console.log('adding photo with id=' + photoData.id);
        //    createPhotoElement($('#bulletin'), photoData.url, photoData.id);
        //    // apply saved rotation
        //    $('#' + photoData.id).css('transform', photoData.rotation);
        //}


    }
}

/**
 * Courtesy of https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Math/random
 *
 * Returns a random integer between min (inclusive) and max (inclusive)
 * Using Math.round() will give you a non-uniform distribution!
 */
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
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

function removePhoto($photoElementId) {
    var $photo = $('#' + $photoElementId);
    $photo.remove();
}
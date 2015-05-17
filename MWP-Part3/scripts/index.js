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
            var imgUrl = 'http://farm' + photo.farm + '.staticflickr.com/' + photo.server + '/' + photo.id + '_' + photo.secret + '_n.jpg';
            var item = '<div class="grid-item"><span><img src="' +imgUrl + '"></span></div>';
            $('#search-results-container').append(item);
            $('#search-results-container > *').addClass('sliding');
            //// Pre-cache image
            //$('<img />').attr({'src': imgUrl, 'data-image-num': i}).load(function() {
            //    console.log('image loaded');
            //    var imageDataNum = $(this).attr('data-image-num');
            //    $('#photo-' + imageDataNum).css('background-image', 'url(' + imgUrl + ')').removeClass('fade-out').addClass('fade-in');
            //});

        });
    });
    photoPagesRequested++;
});
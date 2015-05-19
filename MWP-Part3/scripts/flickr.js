/**
 * Created by varmarken on 07/05/15.
 */

var apiEndpoint = 'https://api.flickr.com/services/rest/?jsoncallback=?';
var apiKey = '597cb449e3ec5c90279f217e32a239b2';
/**
 * Perform a free text search for photos on flickr.
 * @param searchTerm The text that is part of the title, description or photo tags.
 * @param photosPerPage Number of photos to retrieve per page (call).
 * @param pageNumber The page index.
 * @param onSuccessHandler A handler function to be invoked if/when a response arrives.
 */
function searchFlickr(searchTerm, photosPerPage, pageNumber, onSuccessHandler) {
    var requestData = {
        'method': 'flickr.photos.search',
        'api_key': apiKey,
        'text': searchTerm,
        'page': pageNumber,
        'per_page': photosPerPage,
        'format': 'json'
    };
    $.getJSON(apiEndpoint, requestData, onSuccessHandler);
}

/**
 * Retrieves location data for a photo.
 * @param photoId The ID of the photo for which location data is to be retrieved.
 * @param responseHandler A function that handles the JSON response.
 */
function getPhotoLocation(photoId, responseHandler) {
    var requestData = {
        'method': 'flickr.photos.geo.getLocation',
        'api_key': apiKey,
        'photo_id': photoId,
        'format': 'json'
    };
    $.getJSON(apiEndpoint, requestData, responseHandler);
}
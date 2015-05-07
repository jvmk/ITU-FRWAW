/**
 * Created by varmarken on 07/05/15.
 */

var apiEndpoint = 'https://api.flickr.com/services/rest/?jsoncallback=?';

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
        'api_key': '597cb449e3ec5c90279f217e32a239b2',
        'text': searchTerm,
        'page': pageNumber,
        'per_page': photosPerPage,
        'format': 'json'
    };
    $.getJSON(apiEndpoint, requestData, onSuccessHandler);
}
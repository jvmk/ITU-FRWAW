/* JavaScript that is common to all pages. */

$(document).ready(function() {
    /* Assign click handler for the button that expands the navigation menu. */
    setCollapseEventHandler($('#btn-menu'), $("#navigation-small"));
});

/**
 * Sets an event handler for collapsing/expanding one element when another element is clicked.
 * @param collapseButton The trigger-element, i.e. the element that, when clicked, triggers the collapsing/expansion of collapsibleElement.
 * @param collapsibleElement The element that is collapsed/collapsed.
 */
function setCollapseEventHandler(collapseButton, collapsibleElement) {
    collapseButton.click(function() {
        if (collapsibleElement.hasClass("expanded")) {
            /* If expanded, collapse it. */
            collapsibleElement.removeClass("expanded").addClass("collapsed");
        } else if (collapsibleElement.hasClass("collapsed")) {
            /* If collapsed, expand it. */
            collapsibleElement.removeClass("collapsed").addClass("expanded");
        }
    });
}

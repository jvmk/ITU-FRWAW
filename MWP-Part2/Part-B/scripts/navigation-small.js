/* Script that controls the collapsible navigation. */

$(document).ready(function() {
    console.log("document ready, adding event-handler to collapsible menu");
    /* Assign click handler for the show-menu button. */
    $("#btn-menu").click(function() {
        console.log("onclick for menu button invoked!");

        /* Find the navigation section. */
        var navSmall = $("#navigation-small");
        /* Toggle menu display on/off based on current state. */
        if (navSmall.hasClass("collapsible-navigation-visible")) {
            /* If visible, hide it. */
            navSmall.removeClass("collapsible-navigation-visible").addClass("collapsible-navigation-hidden");

        } else if (navSmall.hasClass("collapsible-navigation-hidden")) {
            /* If hidden, show it. */
            navSmall.removeClass("collapsible-navigation-hidden").addClass("collapsible-navigation-visible");
        }
    });
});

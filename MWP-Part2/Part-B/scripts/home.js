/* JavaScript specific to the home (index) page. */

$(document).ready(function() {
    /* Set event handler for button that collapses/expands the login section on smaller screens */
    setCollapseEventHandler($('#btn-collapse-expand-login'), $('#login-small>form'));
});

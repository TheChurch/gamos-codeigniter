/**
 * Profiles list page
 */
$( function ( $ ) {
    'use strict';

    /**
     * All of the code for our registration JavaScript source
     * should reside in this file.
     *
     * Note that this assume you're going to use jQuery, so it prepares
     * the $ function reference to be used within the scope of this
     * function.
     *
     * From here, we are able to define handlers for when the DOM is
     * ready:
     *
     * $(function() {
     *
     * });
     *
     * Or when the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and so on.
     */
    $( function () {

        // Base url.
        var baseUrl = $( '#base_url' ).val();

        // Initialize select2.
        $( '.select2' ).select2({
            width: '100%'
        });

        // Hide success/error messages after 2 seconds.
        $( '.callout' ).delay( 2000 ).fadeOut( 400 );

        // Data table.
        var oTable = $( '#profiles_table' ).dataTable({
            'processing': true,
            'serverSide': true,
            'searching': false,
            'ajax': {
                'url': baseUrl + 'data/get-profiles',
                'type': 'POST',
                'data' : function ( data ) {
                    data.name = $( '#name' ).val();
                    data.church = $( '#church' ).val();
                    data.gender = $( '#gender' ).val();
                    data.age_from = $( '#age_from' ).val();
                    data.age_to = $( '#age_to' ).val();
                    data.state = $( '#state' ).val();
                    data.district = $( '#district' ).val();
                    data.education = $( '#education' ).val();
                    data.job = $( '#job' ).val();
                }
            },
            "columnDefs": [{
                'orderable': false,
                'targets': [0,2,7]
            }],
        });

        // After datatables loaded.
        oTable.on( 'xhr.dt', function ( e, settings, json, xhr ) {
            if ( json.hasOwnProperty( 'recordsTotal' ) ) {
                $( '#profile_count' ).html( json.recordsTotal );
            }
        });

        // Refresh profiles list on filter.
        $( '.profile-filter' ).on( 'change', function () {
            oTable.fnReloadAjax();
        });

        // Ask for confirmation before delete.
        $( '#profiles_table' ).on( 'click', '.delete', function() {
            return confirm( 'Are you sure? This can\'t be undone.' );
        });
    });
});

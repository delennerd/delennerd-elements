( function( $ ) {

	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */
	var WidgetDlmTimelineHandler = function( $scope, $ ) {

        var element_id = $scope.data().id;
        var element_class = '.elementor-element-'+ element_id;

		wow = new WOW({
            offset: 10
        });
        wow.init();

        prepareTimeline( $, element_class );
	};

	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/dlm-timeline.default', WidgetDlmTimelineHandler );
	} );
} )( jQuery );


function prepareTimeline ($, section_id)
{
    boxes = new Array();
    tl_height = 0;
    margin = 25;
    tl_box = section_id + ' .timeline .timeline-box';
    count_boxes = $(tl_box).length;

    if (count_boxes == 0) {
        return;
    }

    $( tl_box ).each(function(index, element)
    {
        boxes[index] = new Array();
        boxes[index]['height'] = $(this).height();
        tl_height += boxes[index]['height'] ;

        switch (index) {
            case 0:
                $(this).css('top', 0 );
                break;
            case 1:
                $(this).css('top', 70 );
                break;
        }

        if ( count_boxes >= 2 && index > 1 )
        {
            var tmp = boxes[index-2]['box_top'];
            $(this).css('top', tmp );
        }

        boxes[index]['top'] = $(this).position().top;
        boxes[index]['box_top'] = boxes[index]['height'] + boxes[index]['top'] + margin;

        if (index == (count_boxes - 1) )
        {
            tl_height = tl_height - (tl_height * 0.35);
            height_bar = tl_height - (tl_height * 0.15) ;
        }
    });

    $(section_id + ' .timeline').css('height', tl_height);
    $(section_id + ' .timeline-bar').css('height', height_bar);
}

/**
 * Created by lvdingtao on 2018/1/16.
 */

;(function($, window, undefined){

    "use strict";
    $(document).ready(function(){

        cbr_replace();
    });

})(jQuery, window);

// Radio and Check box replacement by Arlind Nushi
function cbr_replace()
{
    var $inputs = jQuery('input[type="checkbox"].cbr, input[type="radio"].cbr').filter(':not(.cbr-done)'),
        $wrapper = '<div class="cbr-replaced"><div class="cbr-input"></div><div class="cbr-state"><span></span></div></div>';

    $inputs.each(function(i, el)
    {
        var $el = jQuery(el),
            is_radio = $el.is(':radio'),
            is_checkbox = $el.is(':checkbox'),
            is_disabled = $el.is(':disabled'),
            styles = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'purple', 'blue', 'red', 'gray', 'pink', 'yellow', 'orange', 'turquoise'];

        if( ! is_radio && ! is_checkbox)
            return;

        $el.after( $wrapper );
        $el.addClass('cbr-done');

        var $wrp = $el.next();
        $wrp.find('.cbr-input').append( $el );

        if(is_radio)
            $wrp.addClass('cbr-radio');

        if(is_disabled)
            $wrp.addClass('cbr-disabled');

        if($el.is(':checked'))
        {
            $wrp.addClass('cbr-checked');
        }


        // Style apply
        jQuery.each(styles, function(key, val)
        {
            var cbr_class = 'cbr-' + val;

            if( $el.hasClass(cbr_class))
            {
                $wrp.addClass(cbr_class);
                $el.removeClass(cbr_class);
            }
        });


        // Events
        $wrp.on('click', function(ev)
        {
            if(is_radio && $el.prop('checked') || $wrp.parent().is('label'))
                return;

            if(jQuery(ev.target).is($el) == false)
            {
                $el.prop('checked', ! $el.is(':checked'));
                $el.trigger('change');
            }
        });

        $el.on('change', function(ev)
        {
            $wrp.removeClass('cbr-checked');

            if($el.is(':checked'))
                $wrp.addClass('cbr-checked');
                location.href=$el.data('url');
            cbr_recheck();
        });
    });
}
function cbr_recheck()
{
    var $inputs = jQuery("input.cbr-done");

    $inputs.each(function(i, el)
    {
        var $el = jQuery(el),
            is_radio = $el.is(':radio'),
            is_checkbox = $el.is(':checkbox'),
            is_disabled = $el.is(':disabled'),
            $wrp = $el.closest('.cbr-replaced');

        if(is_disabled)
            $wrp.addClass('cbr-disabled');

        if(is_radio && ! $el.prop('checked') && $wrp.hasClass('cbr-checked'))
        {
            $wrp.removeClass('cbr-checked');

        }
    });
}


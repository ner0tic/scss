<?php

function scss_link_to($name,$url,$opts = array()) {
  // get user
  $sf_user = sfContext::getInstance()->getUser();
  // get route data for given route
  $sf_route = sfContext::getInstance()->getRouting()->getRoutes();
  $sf_route = $sf_route[$url];
  // use active enrollment troop or assigned troop
  $use_active = isset($opts['use_active']) ? $opts['use_active'] : false;
  unset($opts['use_active']);
  // get slug array
  $_p = array();
  foreach($sf_route->getDefaultParameters() as $r)
    $_p[$r] = Scss::genSlugArray(array(($use_active ? 'a_' : '').$r));
  return link_to($name,$url,array_merge($opts,$_p));
}

    /**
     * Returns a form tag that will submit using XMLHttpRequest in the background instead of the regular
     * reloading POST arrangement. Even though it's using JavaScript to serialize the form elements, the form submission
     * will work just like a regular submission as viewed by the receiving side (all elements available in 'params').
     * The options for specifying the target with 'url' and defining callbacks are the same as 'link_to_remote()'.
     *
     * A "fall-through" target for browsers that don't do JavaScript can be specified
     * with the 'action'/'method' options on '$options_html'
     *
     * Example:
     *  <?php echo form_remote_tag(array(
     *    'url'      => '@tag_add',
     *    'update'   => 'question_tags',
     *    'loading'  => "Element.show('indicator'); \$('tag').value = ''",
     *    'complete' => "Element.hide('indicator');".visual_effect('highlight', 'question_tags'),
     *  )) ?>
     *
     * The hash passed as a second argument is equivalent to the options (2nd) argument in the form_tag() helper.
     *
     * By default the fall-through action is the same as the one specified in the 'url'
     * (and the default method is 'post').
     * 
     * Modified to have parameters with the url
     */
    function scss_form_remote_tag($options = array(), $options_html = array())
    {
        $options = _parse_attributes($options);
        $options_html = _parse_attributes($options_html);
        $options['form'] = true;
        
        $options_html['onsubmit'] = dd_remote_function($options).'; return false;';

        $options_html['action'] = isset($options_html['action']) ? $options_html['action'] : (isset($options['url_params']) ? url_for($options['url'],$options['url_params']) : url_for($options['url']));
        $options_html['method'] = isset($options_html['method']) ? $options_html['method'] : 'post';

        return tag('form', $options_html, true);
    }    

    /**
 * Returns the javascript needed for a remote function.
 * Takes the same arguments as 'link_to_remote()'.
 *
 * Example:
 *   <select id="options" onchange="<?php echo remote_function(array('update' => 'options', 'url' => '@update_options')) ?>">
 *     <option value="0">Hello</option>
 *     <option value="1">World</option>
 *   </select>
 * 
 * modified to allow params in the url
 */
function dd_remote_function($options)
{
  
	// Defining elements to update
	if (isset($options['update']) && is_array($options['update']))
	{
		// On success, update the element with returned data
		if (isset($options['update']['success'])) $update_success = "#".$options['update']['success'];

		// On failure, execute a client-side function
		if (isset($options['update']['failure'])) $update_failure = $options['update']['failure'];
	}
	else if (isset($options['update'])) $update_success = "#".$options['update'];

	// Update method
	$updateMethod = _update_method(isset($options['position']) ? $options['position'] : '');

	// Callbacks
	if (isset($options['loading'])) $callback_loading = $options['loading'];
	if (isset($options['complete'])) $callback_complete = $options['complete'];
	if (isset($options['success'])) $callback_success = $options['success'];

	$execute = 'false';
	if ((isset($options['script'])) && ($options['script'] == '1')) $execute = 'true';

	// Data Type
	if (isset($options['dataType']))
	{
		$dataType = $options['dataType'];
	}
	elseif ($execute)
	{
		$dataType = 'html';
	}
	else
	{
		$dataType = 'text';
	}

	// POST or GET ?
	$method = 'POST';
	if ((isset($options['method'])) && (strtoupper($options['method']) == 'GET')) $method = $options['method'];

	// async or sync, async is default
	if ((isset($options['type'])) && ($options['type'] == 'synchronous')) $type = 'false';

	// Is it a form submitting
	if (isset($options['form'])) $formData = 'jQuery(this).serialize()';
	elseif (isset($options['submit'])) $formData = '{\'#'.$options['submit'].'\'}.serialize()';
	// boutell and JoeZ99: 'with' should not be quoted, it's not useful
	// that way, see the Symfony documentation for the original remote_function
	elseif (isset($options['with'])) $formData = $options['with'];
	// Is it a link with csrf protection
	elseif(isset($options['csrf']) && $options['csrf'] == '1')
	{
		$form = new sfForm();
  		if ($form->isCSRFProtected())
  		{
  			$formData = '{'.$form->getCSRFFieldName().': \''.$form->getCSRFToken().'\'}';
  		}
	}

	// build the function
	$function = "jQuery.ajax({";
	$function .= 'type:\''.$method.'\'';
	$function .= ',dataType:\'' . $dataType . '\'';
	if (isset($type)) $function .= ',async:'.$type;
	if (isset($formData)) $function .= ',data:'.$formData;
	if (isset($update_success) and !isset($callback_success)) $function .= ',success:function(data, textStatus){jQuery(\''.$update_success.'\').'.$updateMethod.'(data);}';
	if (isset($update_failure)) $function .= ',error:function(XMLHttpRequest, textStatus, errorThrown){'.$update_failure.'}';
	if (isset($callback_loading)) $function .= ',beforeSend:function(XMLHttpRequest){'.$callback_loading.'}';
	if (isset($callback_complete)) $function .= ',complete:function(XMLHttpRequest, textStatus){'.$callback_complete.'}';
	if (isset($callback_success)) $function .= ',success:function(data, textStatus){'.$callback_success.'}';
	if(isset($options['url_params'])) $function .= ',url:\''.url_for($options['url'],$options['url_params']).'\'';
    else $function .= ',url:\''.url_for($options['url']).'\'';
	$function .= '})';

	if (isset($options['before']))
	{
		$function = $options['before'].'; '.$function;
	}
	if (isset($options['after']))
	{
		$function = $function.'; '.$options['after'];
	}
	if (isset($options['condition']))
	{
		$function = 'if ('.$options['condition'].') { '.$function.'; }';
	}
	if (isset($options['confirm']))
	{
		$function = "if (confirm('".escape_javascript($options['confirm'])."')) { $function; }";
		if (isset($options['cancel']))
		{
			$function = $function.' else { '.$options['cancel'].' }';
		}
	}
        
	return $function;
}
?>

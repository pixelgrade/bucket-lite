<?php
class ReduxFramework_text_sortable {

    /**
     * Field Constructor.
     *
     * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
     *
     * @since Redux_Options 2.0.1
    */
    function __construct($field = array(), $value ='', $parent) {
        $this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
    }

    /**
     * Field Render Function.
     *
     * Takes the vars and outputs the HTML for the field in the settings
     *
     * @since Redux_Options 2.0.1
    */
    function render() {
        $class = (isset($this->field['class'])) ? $this->field['class'] : '';
        $options = $this->field['options'];

        echo '<ul class="text_sortable ' . $class . '">';
            if (isset($this->value) && is_array($this->value)) {
                foreach ($this->value as $k => $nicename) {
                    $value_display = !empty($this->value[$k]) ? $this->value[$k] : '';
					if (!empty($value_display)) {
						echo '<li>';
						echo '<label for="' . $this->field['id'] . '[' . $k . ']"><strong>' . $options[$k] . ':</strong></label>';
						echo '<input rel="'.$this->field['id'].'-'.$k.'-hidden" type="text" id="' . $this->field['id'] . '[' . $k . ']" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][' . $k . ']" value="' . esc_attr($value_display) . '" />';
						echo '<span class="compact drag"><i class="icon-move icon-large"></i></span>';
						echo '</li>';
						//remove this entry from options
						if (isset($options[$k])) {
							unset($options[$k]);
						}
					}
                }
				
				//if we still have options left
				//show the empty options
				if (!empty($options)) {
					foreach ($options as $k => $nicename) {
						$value_display = isset($this->value[$k]) ? $this->value[$k] : '';
						echo '<li>';
						echo '<label for="' . $this->field['id'] . '[' . $k . ']"><strong>' . $nicename . ':</strong></label>';
						echo '<input rel="'.$this->field['id'].'-'.$k.'-hidden" type="text" id="' . $this->field['id'] . '[' . $k . ']" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][' . $k . ']" value="' . esc_attr($value_display) . '" />';
						echo '<span class="drag"><i class="icon-move icon-large"></i></span>';
						echo '</li>';
					}
				}
            } else {
                foreach ($options as $k => $nicename) {
                    $value_display = isset($this->value[$k]) ? $this->value[$k] : '';
                    echo '<li>';
                    echo '<label for="' . $this->field['id'] . '[' . $k . ']"><strong>' . $nicename . ':</strong></label>';
                    echo '<input rel="'.$this->field['id'].'-'.$k.'-hidden" type="text" id="' . $this->field['id'] . '[' . $k . ']" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][' . $k . ']" value="' . esc_attr($value_display) . '" />';
                    echo '<span class="drag"><i class="icon-move icon-large"></i></span>';
                    echo '</li>';
                }
            }
        echo '</ul>';
    }

    function enqueue() {
        wp_enqueue_script(
            'redux-field-text-sortable-js',
            REDUX_URL . 'inc/fields/text_sortable/field_text_sortable.js',
            array('jquery'),
            time(),
            true
        );
		
		wp_enqueue_style(
			'redux-field-text-sortable-css', 
			REDUX_URL.'inc/fields/text_sortable/field_text_sortable.css', 
			time(),
			true
		);	
    }
}

<?php
/**
 * Manages and renders a checkbox settings field.
 *
 * @uses Carbon_Breadcrumb_Admin_Settings_Field
 */
class Carbon_Breadcrumb_Admin_Settings_Field_Checkbox extends Carbon_Breadcrumb_Admin_Settings_Field {

	/**
	 * Render this field.
	 *
	 * @access public
	 */
	public function render() {
		$original_name = str_replace('carbon_breadcrumbs_', '', $this->get_id());
		$field_data = Carbon_Breadcrumb_Admin_Settings::get_field_data();
		$default = $field_data[$original_name]['default'];
		$value = get_option( $this->get_id() );
		if ($value === false) {
			$value = $default;
		}
		$checked = checked( 1, $value, false );
		?>
		<input name="<?php echo $this->get_id(); ?>" id="<?php echo $this->get_id(); ?>" type="checkbox" value="1" class="code" <?php echo $checked; ?> />
		<?php

		$this->render_help();
	}

}
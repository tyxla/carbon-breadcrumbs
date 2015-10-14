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
		$checked = checked( 1, $this->get_value(), false );
		?>
		<input name="<?php echo esc_attr( $this->get_id() ); ?>" id="<?php echo esc_attr( $this->get_id() ); ?>" type="checkbox" value="1" class="code" <?php echo esc_html( $checked ); ?> />
		<?php
		$this->render_help();
	}

}
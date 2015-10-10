<?php
/**
 * Manages and renders a text settings field.
 *
 * @uses Carbon_Breadcrumb_Admin_Settings_Field
 */
class Carbon_Breadcrumb_Admin_Settings_Field_Text extends Carbon_Breadcrumb_Admin_Settings_Field {

	/**
	 * Render this field.
	 *
	 * @access public
	 */
	public function render() {
		?>
		<input name="<?php echo esc_attr( $this->get_id() ); ?>" id="<?php echo esc_attr( $this->get_id() ); ?>" type="text" value="<?php echo esc_attr( $this->get_value() ); ?>" class="regular-text" />
		<?php
		$this->render_help();
	}

}
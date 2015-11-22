<?php
/**
 * @group locator
 */
class CarbonBreadcrumbLocatorTermGenerateItemsTest extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		$this->locator = $this->getMockForAbstractClass( 'Carbon_Breadcrumb_Locator_Term', array( 'term', 'category' ) );
		$this->category = $this->factory->category->create();
		$this->tag = $this->factory->tag->create();
	}

	public function tearDown() {
		unset( $this->locator );
		unset( $this->category );
		unset( $this->tag );

		parent::tearDown();
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::generate_items
	 */
	public function testWithDefaultTaxonomies() {
		$taxonomies = array(
			'category' => 'cat',
			'tag' => 'tag_id',
		);

		foreach ($taxonomies as $tax => $tax_qv) {
			$this->go_to('/?' . $tax_qv . '=' . $this->$tax );
			$items = $this->locator->generate_items_for_subtypes( array( 'category', 'post_tag' ) );

			$expected = $items;
			$actual = $this->locator->generate_items();

			$this->assertSame( count($expected), count($actual) );
			foreach ($items as $key => $item) {
				$this->assertArrayHasKey( $key, $actual );
				$this->assertSame( $item->get_id(), $actual[$key]->get_id() );
			}
		}
	}

	/**
	 * @covers Carbon_Breadcrumb_Locator_Term::generate_items
	 */
	public function testWithCustomTaxonomies() {
		register_taxonomy('example_tax', array(
			'public' => true,
		));
		$this->example_tax = $this->factory->term->create(array(
			'taxonomy' => 'example_tax',
		));
		$taxonomies = array(
			'example_tax',
		);

		foreach ($taxonomies as $tax) {
			$term = get_term_by('id', $this->example_tax, $tax);
			$this->go_to('/?' . $tax . '=' . $term->slug );
			$items = $this->locator->generate_items_for_subtypes( $taxonomies );

			$expected = $items;
			$actual = $this->locator->generate_items();

			$this->assertSame( count($expected), count($actual) );
			foreach ($items as $key => $item) {
				$this->assertArrayHasKey( $key, $actual );
				$this->assertSame( $item->get_id(), $actual[$key]->get_id() );
			}
		}

		unset($this->example_tax);
	}

}
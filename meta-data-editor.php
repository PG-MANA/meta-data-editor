<?php
/*
 * Plugin Name:       Meta Data Editor
 * Plugin URI:        https://github.com/PG-MANA/meta-data-editor
 * Description:       The personal plugin to add the description and OGP(Open Graph Protocol)
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.0
 * Author:            PG_MANA
 * Author URI:        https://pg-mana.net/
 * License:           Apache License, Version 2.0
 * License URI:       https://www.apache.org/licenses/LICENSE-2.0
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       meta-data-editor
 */

/*
 * Copyright 2024 PG_MANA
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class MetaDataEditor {

	private string $id = 'meta_data_editor';
	private string $ogp_default_image_size = 'medium';
	private array $ogp_default = [
		'image'        => 'https://example.com/favicon.ico',
		'image:width'  => '64',
		'image:height' => '64',
	];

	function initialize(): void {
		require 'ogp-config.php';
		if ( is_admin() ) {
			add_action( 'add_meta_boxes', [ $this, 'add_editor_box' ] );
			add_action( 'save_post', [ $this, 'store_meta_data' ] );
		} else {
			add_action( 'wp_head', [ $this, 'put_meta_data' ] );
			add_filter( 'language_attributes', [ $this, 'add_prefix' ] );
			add_filter( 'the_content', [ $this, 'add_share_button' ] );
		}
	}

	function add_prefix( string $lang ): string {
		return $lang . ' prefix="og: https://ogp.me/ns#"';
	}

	function add_editor_box(): void {
		add_meta_box( $this->id, 'Meta Data Editor', [ $this, 'editor_box_callback' ] );
	}

	function editor_box_callback(): void {
		global $post;
		$description = '';
		$ogp         = [
			'description' => $description,
		];
		$info        = get_post_meta( $post->ID, $this->id, true );
		if ( ! empty( $info ) ) {
			$description = $info['description'];
			$ogp         = $info['ogp'];
		}

		echo '<h3>' . __( 'Description', $this->id ) . '</h3>' .
		     '<div class="wp-editor-container"><textarea id="' . $this->id .
		     '-description" name="' . $this->id . '-description" class="wp-editor-area" cols="60" rows="2">' .
		     $description . '</textarea></div>';
		echo '<h3>' . __( 'Open Graph Protocol', $this->id ) . '</h3>';
		echo '<h4>' . __( 'Image', $this->id ) . '</h4><p>Eye catch or default image</p>';
		echo '<h4>' . __( 'Description', $this->id ) . '</h4><div class="wp-editor-container"><textarea id="' .
		     $this->id . '-ogp-description" name="' . $this->id . '-ogp-description" class="wp-editor-area" cols="60" rows="2"> ' .
		     ( $ogp['description'] ?? '' ) . '</textarea></div>';
		wp_nonce_field( $this->id . '_editor_box', $this->id . '_editor_box_nonce' );
	}

	function store_meta_data( int $post_id ): void {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if ( ! wp_verify_nonce( $_POST[ $this->id . '_editor_box_nonce' ] ?? '', $this->id . '_editor_box' ) ) {
			return;
		}
		if ( empty( $_POST[ $this->id . '-description' ] ) ) {
			return;
		}
		$description = sanitize_text_field( $_POST[ $this->id . '-description' ] );

		/* OGP Settings */
		$ogp       = [
			'description' => ! empty( $_POST[ $this->id . '-ogp-description' ] ) ? sanitize_text_field( $_POST[ $this->id . '-ogp-description' ] ) : ''
		];
		$thumbnail = get_post_thumbnail_id();
		if ( $thumbnail !== false ) {
			$image_url  = wp_get_attachment_image_url( $thumbnail, $this->ogp_default_image_size );
			$image_info = wp_get_attachment_metadata( $thumbnail, $this->ogp_default_image_size );
			if ( $image_url !== false && ! empty( $image_info ) && ! empty( $image_info['sizes'][ $this->ogp_default_image_size ] ) ) {
				$ogp['image']        = $image_url;
				$ogp['image:width']  = $image_info['sizes'][ $this->ogp_default_image_size ]['width'];
				$ogp['image:height'] = $image_info['sizes'][ $this->ogp_default_image_size ]['height'];
			}
		}

		update_post_meta( $post_id, $this->id, [
			'description' => $description,
			'ogp'         => $ogp
		] );
	}

	function put_meta_data(): void {
		$title       = get_bloginfo( 'name' );
		$ogp         = [];
		$description = '';
		echo '<meta property="og:site_name" content="' . $title . '" />';
		echo '<meta property="og:locale" content="' . get_bloginfo( 'language' ) . '" />';
		if ( is_page() || is_single() ) {
			global $post;
			$info = get_post_meta( $post->ID, $this->id, true );
			if ( empty( $info ) ) {
				return;
			}
			foreach ( $this->ogp_default as $key => $value ) {
				if ( ! isset( $info['ogp'][ $key ] ) ) {
					$info['ogp'][ $key ] = $value;
				}
			}
			$description = $info['description'];
			$ogp         = [
				'type'                   => 'article',
				'title'                  => $post->post_title . ' &#8211; ' . $title,
				'description'            => $info['ogp']['description'] ?? $info['description'],
				'url'                    => get_permalink(),
				'image'                  => $info['ogp']['image'],
				'image:secure_url'       => $info['ogp']['image'],
				'image:width'            => $info['ogp']['image:width'],
				'image:height'           => $info['ogp']['image:height'],
				'article:published_time' => $post->post_date_gmt,
				'article:modified_time'  => $post->post_modified_gmt,
			];
		} else if ( is_tag() || is_category() ) {
			$term_id     = get_queried_object()->term_id;
			$description = sanitize_text_field( term_description( $term_id ) );
			$ogp         = [
				'type'             => 'article',
				'title'            => get_term_field( 'name', $term_id ) . ' &#8211; ' . $title,
				'description'      => $description,
				'url'              => get_term_link( $term_id ),
				'image'            => $this->ogp_default['image'],
				'image:secure_url' => $this->ogp_default['image'],
				'image:width'      => $this->ogp_default['image:width'],
				'image:height'     => $this->ogp_default['image:height'],
			];
		} else if ( is_front_page() ) {
			$description = get_bloginfo( 'description' );
			$ogp         = [
				'type'             => 'article',
				'title'            => $title,
				'description'      => $description,
				'url'              => get_bloginfo( 'url' ),
				'image'            => $this->ogp_default['image'],
				'image:secure_url' => $this->ogp_default['image'],
				'image:width'      => $this->ogp_default['image:width'],
				'image:height'     => $this->ogp_default['image:height'],
			];
		}
		echo '<meta name="description" content="' . $description . '" />';
		foreach ( $ogp as $key => $value ) {
			echo '<meta property="og:' . $key . '" content="' . $value . '" />';
		}
	}

	function add_share_button( string $content ): string {
		if ( ! ( is_page() || is_single() ) ) {
			return $content;
		}
		$post_url   = urlencode( get_permalink() );
		$share_text = urlencode( html_entity_decode( get_the_title() . ' - ' . get_bloginfo( 'name' ) ) );
		$share_html = require 'share-button.php';

		return $share_html . $content . $share_html;
	}
}

$MetaInfoEditor = new MetaDataEditor();
$MetaInfoEditor->initialize();

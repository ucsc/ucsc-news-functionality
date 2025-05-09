<?php
/**
 * Remove some core and plugin dashboard meta boxes
 */
add_action('admin_init', 'ucsc_wp_remove_dashboard_meta');

function ucsc_wp_remove_dashboard_meta()
{
  remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
  remove_meta_box('dashboard_primary', 'dashboard', 'side');
  remove_meta_box('dashboard_secondary', 'dashboard', 'normal');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
  remove_meta_box('wpseo-dashboard-overview', 'dashboard', 'normal');
  remove_meta_box('wpseo-wincher-dashboard-overview', 'dashboard', 'normal');
}

/**
 * Add dashboard help meta box
 */
add_action('wp_dashboard_setup', 'ucsc_intro_meta_box');

function ucsc_intro_meta_box()
{
  wp_add_dashboard_widget(
    'ucsc_intro_meta_box_widget',
    'UC Santa Cruz News',   
    'ucsc_intro_meta_box_function',
    null,
    null,
    'normal',
    'high'
  );
}
// Meta box content
function ucsc_intro_meta_box_function()
{
  echo '<p><i class="dashicons dashicons-welcome-write-blog"></i> See the <a href="https://communications.ucsc.edu/editorial/editorial-style-guide/">UCSC editorial style guide</a> for writing guidelines.</p><p><i class="dashicons dashicons-tag"></i> See the <a href="https://docs.google.com/document/d/1gGwGWUMPyNMk9ddqGx3Tdp805W3uJTfvpZudOUjf2Xk/">taxonomy guide</a> for help categorizing your posts.</p><p><i class="dashicons dashicons-format-image"></i> Images are available in the campus <a href="https://photos.ucsc.edu">photo library</a>.</p><p><i class="dashicons dashicons-flag"></i> For help, use the <a href="https://app.slack.com/client/T044B8579/C08PC13JN11"><code>#news-help</code></a> channel in Slack, or <a href="mailto:news-help-aaaap74fpvb7grwfsyojvp6uhy@ucsc-marcomm.slack.com">send an email</a>.</p>';
}

/**
 * Register a dashboard meta box to show recent tags
 */
add_action('wp_dashboard_setup', 'register_taxonomy_terms_meta_box');

function register_taxonomy_terms_meta_box()
{
  add_meta_box(
    'ucsc_taxonomy_terms_meta_box',       // Meta box ID
    'Popular Tags',                       // Title
    'display_taxonomy_terms_meta_box',    // Callback function
    'dashboard',                          // Screen (dashboard)
    'side'                                // Context
  );
}

// Callback function to display taxonomy terms
function display_taxonomy_terms_meta_box()
{
  // Set the taxonomy name
  $taxonomy = 'post_tag';

  // Get all terms from the taxonomy
  $terms = get_terms([
    'taxonomy' => $taxonomy,
    'hide_empty' => 1,
    'number' => 16,
    'orderby' => 'count',
    'order' => 'DESC'
  ]);

  // Display the terms
  if (!empty($terms) && !is_wp_error($terms)) {
    echo '<ul>';
    foreach ($terms as $term) {
      echo '<li>';
      echo '<a href="' . esc_url(get_term_link($term->term_id, $taxonomy)) . '">';
      echo esc_html($term->name) . ' (' . $term->count . ')';
      echo '</a>';
      echo '</li>';
    }
    echo '</ul>';

  // If there are no terms found, display a message  
  } else {
    echo '<p>No terms found in this taxonomy.</p>';
  }
}
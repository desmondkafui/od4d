<?php
/**
 * Page titles
 */
function kadence_title() {
  if (is_home()) {
    if (get_option('page_for_posts', true)) {
      $title = get_the_title(get_option('page_for_posts', true));
    } else {
      $title = __('Latest Posts', 'pinnacle');
    }
  } elseif (is_archive()) {
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    if ($term) {
      $title = $term->name;
    } elseif (is_post_type_archive()) {
      $title = get_queried_object()->labels->name;
    } elseif (is_day()) {
      $title = sprintf(__('Daily Archives: %s', 'pinnacle'), get_the_date());
    } elseif (is_month()) {
      $title = sprintf(__('Monthly Archives: %s', 'pinnacle'), get_the_date('F Y'));
    } elseif (is_year()) {
      $title = sprintf(__('Yearly Archives: %s', 'pinnacle'), get_the_date('Y'));
    } elseif (is_author()) {
      $title = sprintf(__('Author Archives: %s', 'pinnacle'), get_the_author());
    } else {
      $title = single_cat_title("", false);
    }
  } elseif (is_search()) {
    $title = sprintf(__('Search Results for %s', 'pinnacle'), get_search_query());
  } elseif (is_404()) {
    $title = __('Not Found', 'pinnacle');
  } else {
    $title = get_the_title();
  }
  return apply_filters('kadence_title', $title);
}

/**
 * Return WordPress subdirectory if applicable
 */
function wp_base_dir() {
  preg_match('!(https?://[^/|"]+)([^"]+)?!', site_url(), $matches);
  if (count($matches) === 3) {
    return end($matches);
  } else {
    return '';
  }
}

/**
 * Opposite of built in WP functions for trailing slashes
 */
function leadingslashit($string) {
  return '/' . unleadingslashit($string);
}

function unleadingslashit($string) {
  return ltrim($string, '/');
}

function add_filters($tags, $function) {
  foreach($tags as $tag) {
    add_filter($tag, $function);
  }
}

function is_element_empty($element) {
  $element = trim($element);
  return empty($element) ? false : true;
}



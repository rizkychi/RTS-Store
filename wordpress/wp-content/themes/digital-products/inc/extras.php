<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Digital Products wordpress Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function digital_products_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'digital_products_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function digital_products_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'digital_products_pingback_header' );
function digital_products_time_zone(){
	return array (
	    'UTC-11:00' => 'Pacific/Midway (UTC-11:00)',
	    'UTC-11:00' => 'Pacific/Samoa (UTC-11:00)',
	    'UTC-10:00' => 'Pacific/Honolulu (UTC-11:00)',
	    'UTC-09:00' => 'US/Alaska (UTC-11:00)',
	    'UTC-08:00' => 'America/Los_Angeles (UTC-08:00)',
	    'UTC-08:00' => 'America/Tijuana (UTC-08:00)',
	    'UTC-07:00' => 'US/Arizona (UTC-07:00)',
	    'UTC-07:00' => 'America/Chihuahua (UTC-07:00)',
	    'UTC-07:00' => 'America/Mazatlan (UTC-07:00)',
	    'UTC-07:00' => 'US/Mountain (UTC-07:00)',
	    'UTC-06:00' => 'America/Managua (UTC-06:00)',
	    'UTC-06:00' => 'US/Central (UTC-06:00)',
	    'UTC-06:00' => 'America/Mexico_City (UTC-06:00)',
	    'UTC-06:00' => 'America/Monterrey (UTC-06:00)',
	    'UTC-06:00' => 'Canada/Saskatchewan (UTC-06:00)',
	    'UTC-05:00' => 'America/Bogota (UTC-05:00)',
	    'UTC-05:00' => 'US/Eastern (UTC-05:00)',
	    'UTC-05:00' => 'US/East-Indiana (UTC-05:00)',
	    'UTC-05:00' => 'America/Lima (UTC-05:00)',
	    'UTC-04:00' => 'Canada/Atlantic (UTC-04:00)',
	    'UTC-04:00' => 'America/La_Paz (UTC-04:00)',
	    'UTC-04:00' => 'America/Santiago (UTC-04:00)',
	    'UTC-04:30' => 'America/Caracas (UTC-04:30)',
	    'UTC-03:30' => 'Canada/Newfoundland (UTC-03:30)',
	    'UTC-03:00' => 'America/Sao_Paulo (UTC-03:00)',
	    'UTC-03:00' => 'America/Argentina/Buenos_Aires (UTC-03:00)',
	    'UTC-03:00' => 'America/Godthab (UTC-03:00)',
	    'UTC-02:00' => 'America/Noronha (UTC-02:00)',
	    'UTC-01:00' => 'Atlantic/Azores (UTC-01:00)',
	    'UTC-01:00' => 'Atlantic/Cape_Verde (UTC-01:00)',
	    'UTC+00:00' => 'Africa/Casablanca (UTC+00:00)',
	    'UTC+00:00' => 'Europe/London (UTC+00:00)',
	    'UTC+00:00' => 'Etc/Greenwich (UTC+00:00)',
	    'UTC+00:00' => 'Europe/Lisbon (UTC+00:00)',
	    'UTC+00:00' => 'Africa/Monrovia (UTC+00:00)',
	    'UTC+00:00' => 'UTC (UTC+00:00)',
	    'UTC+01:00' => 'Europe/Amsterdam (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Belgrade (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Berlin (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Bratislava (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Brussels (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Budapest (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Copenhagen (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Ljubljana (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Madrid (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Paris (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Prague (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Rome (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Sarajevo (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Skopje (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Stockholm (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Vienna (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Warsaw (UTC+01:00)',
	    'UTC+01:00' => 'Africa/Lagos (UTC+01:00)',
	    'UTC+01:00' => 'Europe/Zagreb (UTC+01:00)',
	    'UTC+02:00' => 'Europe/Athens (UTC+02:00)',
	    'UTC+02:00' => 'Europe/Bucharest (UTC+02:00)',
	    'UTC+02:00' => 'Africa/Cairo (UTC+02:00)',
	    'UTC+02:00' => 'Africa/Harare (UTC+02:00)',
	    'UTC+02:00' => 'Europe/Helsinki (UTC+02:00)',
	    'UTC+02:00' => 'Europe/Istanbul (UTC+02:00)',
	    'UTC+02:00' => 'Asia/Jerusalem (UTC+02:00)',
	    'UTC+02:00' => 'Africa/Johannesburg (UTC+02:00)',
	    'UTC+02:00' => 'Europe/Riga (UTC+02:00)',
	    'UTC+02:00' => 'Europe/Sofia (UTC+02:00)',
	    'UTC+02:00' => 'Europe/Tallinn (UTC+02:00)',
	    'UTC+02:00' => 'Europe/Vilnius (UTC+02:00)',
	    'UTC+03:00' => 'Asia/Baghdad (UTC+03:00)',
	    'UTC+03:00' => 'Asia/Kuwait (UTC+03:00)',
	    'UTC+03:00' => 'Europe/Minsk (UTC+03:00)',
	    'UTC+03:00' => 'Africa/Nairobi (UTC+03:00)',
	    'UTC+03:00' => 'Asia/Riyadh (UTC+03:00)',
	    'UTC+03:00' => 'Europe/Volgograd (UTC+03:00)',
	    'UTC+03:30' => 'Asia/Tehran (UTC+03:30)',
	    'UTC+04:00' => 'Asia/Muscat (UTC+04:00)',
	    'UTC+04:00' => 'Asia/Baku (UTC+04:00)',
	    'UTC+04:00' => 'Europe/Moscow (UTC+04:00)',
	    'UTC+04:00' => 'Asia/Tbilisi (UTC+04:00)',
	    'UTC+04:00' => 'Asia/Yerevan (UTC+04:00)',
	    'UTC+04:30' => 'Asia/Kabul (UTC+04:30)',
	    'UTC+05:00' => 'Asia/Karachi (UTC+05:00)',
	    'UTC+05:00' => 'Asia/Tashkent (UTC+05:00)',
	    'UTC+05:30' => 'Asia/Kolkata (UTC+05:30)',
	    'UTC+05:45' => 'Asia/Katmandu (UTC+05:45)',
	    'UTC+06:00' => 'Asia/Almaty (UTC+06:00)',
	    'UTC+06:00' => 'Asia/Dhaka (UTC+06:00)',
	    'UTC+06:00' => 'Asia/Yekaterinburg (UTC+06:00)',
	    'UTC+06:30' => 'Asia/Rangoon (UTC+06:30)',
	    'UTC+07:00' => 'Asia/Bangkok (UTC+07:00)',
	    'UTC+07:00' => 'Asia/Jakarta (UTC+07:00)',
	    'UTC+07:00' => 'Asia/Novosibirsk (UTC+07:00)',
	    'UTC+08:00' => 'Asia/Hong_Kong (UTC+08:00)',
	    'UTC+08:00' => 'Asia/Chongqing (UTC+08:00)',
	    'UTC+08:00' => 'Asia/Krasnoyarsk (UTC+08:00)',
	    'UTC+08:00' => 'Asia/Kuala_Lumpur (UTC+08:00)',
	    'UTC+08:00' => 'Australia/Perth (UTC+08:00)',
	    'UTC+08:00' => 'Asia/Singapore (UTC+08:00)',
	    'UTC+08:00' => 'Asia/Taipei (UTC+08:00)',
	    'UTC+08:00' => 'Asia/Ulan_Bator (UTC+08:00)',
	    'UTC+08:00' => 'Asia/Urumqi (UTC+08:00)',
	    'UTC+09:00' => 'Asia/Irkutsk (UTC+09:00)',
	    'UTC+09:00' => 'Asia/Tokyo (UTC+09:00)',
	    'UTC+09:00' => 'Asia/Seoul (UTC+09:00)',
	    'UTC+09:30' => 'Australia/Adelaide (UTC+09:30)',
	    'UTC+09:30' => 'Australia/Darwin (UTC+09:30)',
	    'UTC+10:00' => 'Australia/Brisbane (UTC+10:00)',
	    'UTC+10:00' => 'Australia/Canberra (UTC+10:00)',
	    'UTC+10:00' => 'Pacific/Guam (UTC+10:00)',
	    'UTC+10:00' => 'Australia/Hobart (UTC+10:00)',
	    'UTC+10:00' => 'Australia/Melbourne (UTC+10:00)',
	    'UTC+10:00' => 'Pacific/Port_Moresby (UTC+10:00)',
	    'UTC+10:00' => 'Australia/Sydney (UTC+10:00)',
	    'UTC+10:00' => 'Asia/Yakutsk (UTC+10:00)',
	    'UTC+11:00' => 'Asia/Vladivostok (UTC+11:00)',
	    'UTC+12:00' => 'Pacific/Auckland (UTC+12:00)',
	    'UTC+12:00' => 'Pacific/Fiji (UTC+12:00)',
	    'UTC+12:00' => 'Pacific/Kwajalein (UTC+12:00)',
	    'UTC+12:00' => 'Asia/Kamchatka (UTC+12:00)',
	    'UTC+12:00' => 'Asia/Magadan (UTC+12:00)',
	    'UTC+13:00' => 'Pacific/Tongatapu (UTC+13:00)'
	);
}
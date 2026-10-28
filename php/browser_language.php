<?php
	function get_browser_language(string $fallback_language = 'en'): string {
		$browser_header   = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
		$browser_language = $fallback_language;
		$best_quality     = -1.0;

		foreach (explode(',', $browser_header) as $part) {
			$pieces   = explode(';q=', trim($part));
			$language = strtolower(explode('-', $pieces[0])[0]);
			$quality  = isset($pieces[1]) ? (float) $pieces[1] : 1.0;

			if (strlen($language) === 2 && ctype_alpha($language) && $quality > $best_quality) {
				$browser_language = $language;
				$best_quality     = $quality;
			}
		}

		return $browser_language;
	}

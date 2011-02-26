<?php
/**
 * Simple relative path normalizer utility.
 *
 * @author A.Grandt
 * @version 0.10
 */
class RelativePath {
	const VERSION = 0.10;

	/**
	 * Clean up a path
	 * If the path starts with a "/", it is deemed absolute and any /../ in the beginning is stripped off.
	 * The returned path will not end in a "/".
	 *
	 * @param String $relPath The path to clean up
	 * @return String the clean path
	 */
	static function getPath($relPath) {
		$relPath = str_replace("\\", "/", $relPath);
		$relPath = preg_replace("#/+\.?/+#", "/", $relPath);
		$relPath = preg_replace('#^(\./)+#', '', $relPath);

		do {
			$relPath = preg_replace('#\w+/\.\./#', '', $relPath, -1, $count);
		} while ($count > 0);

		$relPath = preg_replace('#^(/\.\.)+\/#', '/', $relPath);
		return preg_replace('#/$#', '', $relPath);
	}
}
<?php
class Genome_Genome_Model_Observer
{
	public function addAutoloader()
	{
		spl_autoload_register(array($this, 'load'), true, true);
	}

	/**
	 * This function can autoloads classes starting with:
	 * - Genome
	 * - Psr
	 *
	 * @param string $class
	 */
	public static function load($class)
	{
		if (preg_match('/^(Genome|Psr)\b/', $class)) {
			$phpFile = Mage::getBaseDir('lib') . DS . str_replace('\\', DS, $class) . '.php';
			if (file_exists($phpFile)) {
				require_once($phpFile);
			}
		}
	}
}
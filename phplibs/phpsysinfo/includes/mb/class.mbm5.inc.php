<?php
/**
 * MBM5 sensor class, getting information from Motherboard Monitor 5 information retrival through csv file
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PSI_Sensor
 * @author    Michael Cramer <BigMichi1@users.sourceforge.net>
 * @copyright 2009 phpSysInfo
 * @license   http://opensource.org/licenses/gpl-2.0.php GNU General Public License version 2, or (at your option) any later version
 * @version   Release: 3.0
 * @link      http://phpsysinfo.sourceforge.net
 */
class MBM5 extends Sensors
{
    /**
     * array with the names of the labels
     *
     * @var array
     */
    private $_buf_label = array();

    /**
     * array withe the values
     *
     * @var array
     */
    private $_buf_value = array();

    /**
     * read the MBM5.csv file and fill the private arrays
     */
    public function __construct()
    {
        parent::__construct();
        if ((PSI_OS == 'WINNT') && !defined('PSI_EMU_HOSTNAME')) {
            $delim = "/;/";
            CommonFunctions::rftsdata("MBM5.csv", $buffer);
            if (strpos($buffer, ";") === false) {
                $delim = "/,/";
            }
            $buffer = preg_split("/\n/", $buffer, -1, PREG_SPLIT_NO_EMPTY);
            $this->_buf_label = preg_split($delim, substr($buffer[0], 0, -2), -1, PREG_SPLIT_NO_EMPTY);
            $this->_buf_value = preg_split($delim, substr($buffer[1], 0, -2), -1, PREG_SPLIT_NO_EMPTY);
        }
    }

    /**
     * get temperature information
     *
     * @return void
     */
    private function _temperature()
    {
        for ($intPosi = 3; $intPosi < 6; $intPosi++) {
            if ($this->_buf_value[$intPosi] == 0) {
                continue;
            }
            preg_match("/([0-9\.])*/", str_replace(",", ".", $this->_buf_value[$intPosi]), $hits);
            $dev = new SensorDevice();
            $dev->setName($this->_buf_label[$intPosi]);
            $dev->setValue($hits[0]);
//            $dev->setMax(70);
            $this->mbinfo->setMbTemp($dev);
        }
    }

    /**
     * get fan information
     *
     * @return void
     */
    private function _fans()
    {
        for ($intPosi = 13; $intPosi < 16; $intPosi++) {
            if (!isset($this->_buf_value[$intPosi])) {
                continue;
            }
            preg_match("/([0-9\.])*/", str_replace(",", ".", $this->_buf_value[$intPosi]), $hits);
            $dev = new SensorDevice();
            $dev->setName($this->_buf_label[$intPosi]);
            $dev->setValue($hits[0]);
//            $dev->setMin(3000);
            $this->mbinfo->setMbFan($dev);
        }
    }

    /**
     * get voltage information
     *
     * @return void
     */
    private function _voltage()
    {
        for ($intPosi = 6; $intPosi < 13; $intPosi++) {
            if ($this->_buf_value[$intPosi] == 0) {
                continue;
            }
            preg_match("/([0-9\.])*/", str_replace(",", ".", $this->_buf_value[$intPosi]), $hits);
            $dev = new SensorDevice();
            $dev->setName($this->_buf_label[$intPosi]);
            $dev->setValue($hits[0]);
            $this->mbinfo->setMbVolt($dev);
        }
    }

    /**
     * get the information
     *
     * @see PSI_Interface_Sensor::build()
     *
     * @return void
     */
    public function build()
    {
        $this->_fans();
        $this->_temperature();
        $this->_voltage();
    }
}

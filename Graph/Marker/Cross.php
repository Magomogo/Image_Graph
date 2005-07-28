<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Image_Graph - PEAR PHP OO Graph Rendering Utility.
 *
 * PHP versions 4 and 5
 *
 * LICENSE: This library is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version. This library is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser
 * General Public License for more details. You should have received a copy of
 * the GNU Lesser General Public License along with this library; if not, write
 * to the Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA
 * 02111-1307 USA
 *
 * @category   Images
 * @package    Image_Graph
 * @subpackage Marker
 * @author     Jesper Veggerby <pear.nosey@veggerby.dk>
 * @copyright  Copyright (C) 2003, 2004 Jesper Veggerby Hansen
 * @license    http://www.gnu.org/copyleft/lesser.html  LGPL License 2.1
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/Image_Graph
 */

/**
 * Include file Image/Graph/Marker.php
 */
require_once 'Image/Graph/Marker.php';

/**
 * Data marker as a cross.
 *
 * @category   Images
 * @package    Image_Graph
 * @subpackage Marker
 * @author     Jesper Veggerby <pear.nosey@veggerby.dk>
 * @copyright  Copyright (C) 2003, 2004 Jesper Veggerby Hansen
 * @license    http://www.gnu.org/copyleft/lesser.html  LGPL License 2.1
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/Image_Graph
 */
class Image_Graph_Marker_Cross extends Image_Graph_Marker
{

	/**
	 * The thickness of the plus in pixels (thickness is actually double this)
	 * @var int
	 * @access private
	 */
	var $_thickness = 2;
	
    /**
     * Draw the marker on the canvas
     *
     * @param int $x The X (horizontal) position (in pixels) of the marker on the canvas
     * @param int $y The Y (vertical) position (in pixels) of the marker on the canvas
     * @param array $values The values representing the data the marker 'points' to
     * @access private
     */
    function _drawMarker($x, $y, $values = false)
    {
    	if ($this->_thickness > 0) {
	    	$this->_getLineStyle();
	        $this->_getFillStyle();
	        
	        $d1 = round(0.7071067 * $this->_size); // cos/sin(45 de>)
	        $d2 = round(0.7071067 * $this->_thickness); // cos/sin(45 deg)
	        
	        $this->_driver->polygonAdd($x - $d1 - $d2, $y - $d1 + $d2); 
	        $this->_driver->polygonAdd($x - $d1 + $d2, $y - $d1 - $d2); 
	        $this->_driver->polygonAdd($x, $y - 2 * $d2); 
	        $this->_driver->polygonAdd($x + $d1 - $d2, $y - $d1 - $d2); 
	        $this->_driver->polygonAdd($x + $d1 + $d2, $y - $d1 + $d2); 
	        $this->_driver->polygonAdd($x + 2 * $d2, $y); 
	        $this->_driver->polygonAdd($x + $d1 + $d2, $y + $d1 - $d2); 
	        $this->_driver->polygonAdd($x + $d1 - $d2, $y + $d1 + $d2); 
	        $this->_driver->polygonAdd($x, $y + 2 * $d2); 
	        $this->_driver->polygonAdd($x - $d1 + $d2, $y + $d1 + $d2); 
	        $this->_driver->polygonAdd($x - $d1 - $d2, $y + $d1 - $d2); 
	        $this->_driver->polygonAdd($x - 2 * $d2, $y); 
	        $this->_driver->polygonEnd();
    	} else {        
	        $this->_getLineStyle();
	        $this->_driver->line(
	            $x - $this->_size,
	            $y - $this->_size,
	            $x + $this->_size,
	            $y + $this->_size
	        );
	
	        $this->_getLineStyle();
	        $this->_driver->line(
	            $x + $this->_size,
	            $y - $this->_size,
	            $x - $this->_size,
	            $y + $this->_size
	        );
    	}
        parent::_drawMarker($x, $y, $values);
    }

}

?>
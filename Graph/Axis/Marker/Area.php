<?php
// +--------------------------------------------------------------------------+
// | Image_Graph                                                              |
// +--------------------------------------------------------------------------+
// | Copyright (C) 2003, 2004 Jesper Veggerby                                 |
// | Email         pear.nosey@veggerby.dk                                     |
// | Web           http://pear.veggerby.dk                                    |
// | PEAR          http://pear.php.net/package/Image_Graph                    |
// +--------------------------------------------------------------------------+
// | This library is free software; you can redistribute it and/or            |
// | modify it under the terms of the GNU Lesser General Public               |
// | License as published by the Free Software Foundation; either             |
// | version 2.1 of the License, or (at your option) any later version.       |
// |                                                                          |
// | This library is distributed in the hope that it will be useful,          |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of           |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU        |
// | Lesser General Public License for more details.                          |
// |                                                                          |
// | You should have received a copy of the GNU Lesser General Public         |
// | License along with this library; if not, write to the Free Software      |
// | Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA |
// +--------------------------------------------------------------------------+

/**
 * Image_Graph - PEAR PHP OO Graph Rendering Utility.
 * @package Image_Graph
 * @subpackage Grid     
 * @category images
 * @copyright Copyright (C) 2003, 2004 Jesper Veggerby Hansen
 * @license http://www.gnu.org/licenses/lgpl.txt GNU Lesser General Public License
 * @author Jesper Veggerby <pear.nosey@veggerby.dk>
 * @version $Id$
 */ 

/**
 * Include file Image/Graph/Grid.php
 */
require_once 'Image/Graph/Grid.php';

/**
 * Display a grid
 * {@see Image_Graph_Grid} 
 */
class Image_Graph_Axis_Marker_Area extends Image_Graph_Grid 
{
    
    /**
     * The lower bound
     * @var double
     * @access private
     */
    var $_lower = false;
    
    /**
     * The upper bound
     * @var double
     * @access private
     */
    var $_upper = false;
    
    /**
     * Sets the lower bound of the area (value on the axis)
     * @param double $lower the lower bound
     */
    function setLowerBound($lower) {
        $this->_lower = $lower;
    }

    /**
     * Sets the upper bound of the area (value on the axis)
     * @param double $upper the upper bound
     */
    function setUpperBound($upper) {
        $this->_upper = $upper;
    }

    /**
     * Output the grid
     * @access private      
     */
    function _done()
    {
        parent::_done();

        if (!$this->_primaryAxis) {
            return false;
        }

        $i = 0;
        
        $this->_lower = max($this->_primaryAxis->_getMinimum(), $this->_lower);
        $this->_upper = min($this->_primaryAxis->_getMaximum(), $this->_upper);

        $secondaryPoints = $this->_getSecondaryAxisPoints();

        reset($secondaryPoints);
        list ($id, $previousSecondaryValue) = each($secondaryPoints);
        while (list ($id, $secondaryValue) = each($secondaryPoints)) {
            if ($this->_primaryAxis->_type == IMAGE_GRAPH_AXIS_X) {                
                $p1 = array ('Y' => $secondaryValue, 'X' => $this->_lower);
                $p2 = array ('Y' => $previousSecondaryValue, 'X' => $this->_lower);
                $p3 = array ('Y' => $previousSecondaryValue, 'X' => $this->_upper);
                $p4 = array ('Y' => $secondaryValue, 'X' => $this->_upper);
            } else {
                $p1 = array ('X' => $secondaryValue, 'Y' => $this->_lower);
                $p2 = array ('X' => $previousSecondaryValue, 'Y' => $this->_lower);
                $p3 = array ('X' => $previousSecondaryValue, 'Y' => $this->_upper);
                $p4 = array ('X' => $secondaryValue, 'Y' => $this->_upper);
            }

            $polygon[] = $this->_pointX($p1);
            $polygon[] = $this->_pointY($p1);
            $polygon[] = $this->_pointX($p2);
            $polygon[] = $this->_pointY($p2);
            $polygon[] = $this->_pointX($p3);
            $polygon[] = $this->_pointY($p3);
            $polygon[] = $this->_pointX($p4);
            $polygon[] = $this->_pointY($p4);

            $previousSecondaryValue = $secondaryValue;

            ImageFilledPolygon($this->_canvas(), $polygon, 4, $this->_getFillStyle());
            unset ($polygon);
        }
    }

}

?>
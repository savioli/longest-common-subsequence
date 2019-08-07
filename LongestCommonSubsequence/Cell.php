<?php

/*
 * Longest Common Subsequence
 *
 * (c) André Savioli <andre_savioli@hotmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      https://github.com/savioli/longest-common-subsequence
 * @copyright Copyright (c) André Savioli
 * @license   https://github.com/savioli/longest-common-subsequence/blob/master/LICENSE (MIT License)
 */

namespace Savioli\LongestCommonSubsequence;

/**
 * Longest Common Subsequence
 *
 * @author André Savioli
 */

class Cell
{
    const DIRECTION_DIAGONAL = 'D';
    const DIRECTION_LEFT = 'L';
    const DIRECTION_UP = 'U';

    /**
    * The value
    *
    * @var string
    */
    private $value;

    /**
    * The direction
    *
    * @var string
    */
    private $direction;

    /**
     * Setter for $value
     *
     * @param string $value
     */
    public function setValue( $value )
    {
        $this->value = $value;
    }

    /**
     * Getter for $value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Setter for $direction
     *
     * @param string $direction
     */
    public function setDirection( $direction )
    {
        $this->direction = $direction;
    }

    /**
     * Getter for $direction
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

}

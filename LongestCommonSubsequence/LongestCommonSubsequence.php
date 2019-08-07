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

use Savioli\LongestCommonSubsequence\Cell;
use Savioli\LongestCommonSubsequence\EmptySequenceException;

/**
 * Longest Common Subsequence
 *
 * @author André Savioli
 */

class LongestCommonSubsequence
{
    /**
    * The sequence A to search the subsequence
    *
    * @var string
    */
    private $sequenceA;

    /**
    * The sequence B to search in subsequence
    *
    * @var string
    */
    private $sequenceB;

    /**
    * The matrix M x N to compute LCS table
    *
    * @var Savioli\LongestCommonSubsequence\Cell[][]
    */
    private $matrix;

    /**
    * The number of rows of matrix
    *
    * @var int
    */
    private $m;

    /**
    * The number of columns of matrix
    *
    * @var int
    */
    private $n;

    /**
    * The longest common subsequence found
    *
    * @var string
    */
    private $longestCommonSubsequence;

    /**
     * Create new LongestCommonSubsequence
     *
     * @param string $sequenceA The sequence A
     * @param string $sequenceB The sequence B
     *
     * @return mixed
     */
    public function __construct( $sequenceA = '', $sequenceB = '' )
    {

        if( $sequenceA <> '' && $sequenceB <> '' ) {

            $this->sequenceA = $sequenceA;
            $this->sequenceB = $sequenceB;

        }

    }

    /**
     * Setter for $sequenceA
     *
     * @param string $sequenceA
     */
    public function setsequenceA( $sequenceA )
    {

        $this->sequenceA = $sequenceA;

    }

    /**
     * Getter for $sequenceA
     *
     * @return string
     */
    public function getsequenceA()
    {

        return $this->sequenceA;

    }

    /**
     * Setter for $sequenceB
     *
     * @param string $sequenceB
     */
    public function setsequenceB( $sequenceB )
    {

        $this->sequenceB = $sequenceB;

    }

    /**
     * Getter for $sequenceB
     *
     * @return string
     */
    public function getsequenceB()
    {

        return $this->sequenceB;

    }

    /**
     * Initialize Matrix
     */
    private function initializeMatrix()
    {

        $this->m = strlen( $this->sequenceA );
        $this->n = strlen( $this->sequenceB );

        for ( $i = 0; $i <= $this->m; $i++ ) {

            for ( $j = 0; $j <= $this->n; $j++ ) {

                $cell = new Cell();
                $cell->setValue( 0 );
                $this->matrix[$i][$j] = $cell;

            }

        }

    }

    /**
     * Search for Longest Common Subsequence
     */
    private function compute() {

        for ( $i=1; $i <= $this->m; $i++ ) {

            for ( $j=1; $j <= $this->n; $j++ ) {

                if( $this->sequenceA[ $i-1 ] == $this->sequenceB[ $j-1 ] ){

                    $this->matrix[ $i ][ $j ]->setValue( $this->matrix[ $i-1 ][ $j-1 ]->getValue() + 1 );
                    $this->matrix[ $i ][ $j ]->setDirection( Cell::DIRECTION_DIAGONAL );

                }elseif( $this->matrix[ $i-1 ][ $j ]->getValue() >= $this->matrix[ $i ][ $j-1 ]->getValue() ){

                    $this->matrix[ $i ][ $j ]->setValue( $this->matrix[ $i-1 ][ $j ]->getValue() );
                    $this->matrix[ $i ][ $j ]->setDirection( Cell::DIRECTION_UP );

                } else {

                    $this->matrix[ $i ][ $j ]->setValue( $this->matrix[ $i ][ $j-1 ]->getValue() );
                    $this->matrix[ $i ][ $j ]->setDirection( Cell::DIRECTION_LEFT );


                }

            }

        }

    }

    /**
     * Backtrack computation
     */
    private function backtrack( $i, $j )
    {

        if( $i == 0 || $j == 0 ) {

            return;

        } elseif ( $this->matrix[ $i ][ $j ]->getDirection() == Cell::DIRECTION_DIAGONAL ) {

            $this->backtrack( $i-1, $j-1 );

            $this->longestCommonSubsequence .= $this->sequenceA[ $i-1 ];

        } elseif ( $this->matrix[ $i ][ $j ]->getDirection() == Cell::DIRECTION_UP ) {

            $this->backtrack( $i-1, $j );

        } else {

            $this->backtrack( $i, $j-1 );

        }

    }

    /**
     * Getter for $sequenceB
     *
     * @return string
     *
     * @throws Exception if one of the sequences are empty
     */
    public function find()
    {

        if( $this->sequenceA == '' ) {

            throw new InvalidSequenceException( "Please enter the first sequence." );

        }
        
        if( $this->sequenceB == '' ) {

            throw new InvalidSequenceException( "Please enter the second sequence." );

        }

        $this->initializeMatrix();

        $this->compute();

        $this->backtrack( $this->m, $this->n );

        return $this->longestCommonSubsequence;

    }

    /**
     * Getter for computation matrix
     *
     * @return Savioli\LongestCommonSubsequence\Cells[][]
     */
    public function getMatrix()
    {

        return $this->matrix;

    }

    /**
     * Getter for $longestCommonSubsequence
     *
     * @return string
     */
    public function getLongestCommonSubsequence()
    {

        return $this->longestCommonSubsequence;

    }

}

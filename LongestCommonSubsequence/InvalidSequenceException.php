<?php

namespace Savioli\LongestCommonSubsequence;

class InvalidSequenceException extends \Exception {

    public function __construct( $message, $code=null, $previous = null )
    {
        parent::__construct( $message, $code, $previous );
    }

}
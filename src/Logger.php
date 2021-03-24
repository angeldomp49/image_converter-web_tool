<?php 

class Logger{
    public static function log(String $text){
        ?>
        <p> <?php echo( $text ); ?> </p>
        <?php
    }
}
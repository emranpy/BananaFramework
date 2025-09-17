<?php


function yesOrNo($input) {
    return strtolower($input[0]) == 'y' ? true : false;
}
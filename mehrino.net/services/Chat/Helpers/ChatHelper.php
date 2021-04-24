<?php
// Chat helper
function random_username($name, $id) {
    return sprintf('%s_%u', $name, random_int(100000, 999999) + $id);
}

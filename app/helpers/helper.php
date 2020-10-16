<?php
function centsToDollars($amount){
    return '$' . number_format($amount/100, 2, '.', ' ');
}

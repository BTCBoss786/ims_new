<?php

function spell($num) {
   $fmt = new NumberFormatter('en_IN', NumberFormatter::SPELLOUT);
   return ucwords('Rupees ' . str_replace('-', ' ', $fmt->format($num)) . ' Only/-');
}

function money($num, $symbol = true) {
   $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
   if (!$symbol) {
      $fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
   }
   return $fmt->format($num);
}
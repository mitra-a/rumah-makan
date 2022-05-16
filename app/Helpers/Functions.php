<?php

    if (!function_exists('money_format_idr')) {
        function money_format_idr($money)
        {
            if (strpos($money, '.')) {
                $money = str_replace('.', '', $money);
            }
    
            if (strpos($money, ',')) {
                $money = str_replace(',', '', $money);
            }
    
            return 'Rp. ' . number_format($money, 0, '', '.') . ',-';
        }
    }
<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class DateHelper
{
    public static function formatTanggalIndonesia($tanggal)
    {
        $carbonDate = Carbon::parse($tanggal);
        $formattedDate = $carbonDate->timezone('Asia/Jakarta')->locale('id_ID')->isoFormat('LLLL');

        // Ganti nama hari dalam bahasa Indonesia menjadi bahasa Inggris
        $dayNames = [
            'Senin' => 'Monday',
            'Selasa' => 'Tuesday',
            'Rabu' => 'Wednesday',
            'Kamis' => 'Thursday',
            'Jumat' => 'Friday',
            'Sabtu' => 'Saturday',
            'Minggu' => 'Sunday',
        ];


        // Ganti nama bulan dalam bahasa Indonesia menjadi bahasa Inggris
        $monthNames = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        // Lakukan penggantian nama hari dan bulan
        $formattedDate = strtr($formattedDate, $dayNames);
        $formattedDate = strtr($formattedDate, $monthNames);

        // Ganti kata-kata yang mungkin berbeda antara bahasa Indonesia dan Inggris
        $translatedWords = [
            'pukul' => 'at', // Ubah 'pukul' menjadi 'at'
        ];

        // Lakukan penggantian kata-kata
        $formattedDate = strtr($formattedDate, $translatedWords);

        // Output tanggal yang diformat
        return $formattedDate;
    }
}

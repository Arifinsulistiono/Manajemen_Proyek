<?php

namespace Tests\Unit;

use Tests\TestCase;

class PaymentTest extends TestCase
{
    public function test_perhitungan_total_pembayaran()
    {
        $biayaDokter = 100000;
        $biayaObat = 50000;

        $total = $biayaDokter + $biayaObat;

        $this->assertEquals(150000, $total);
    }
}

<?php

namespace Database\Seeders;

use App\Models\BookingClass;
use App\Models\Receipt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $booking = BookingClass::where('status', 'paid')->get();
        foreach ($booking as $book) {
            $receipt = new Receipt();
            $receipt->user_id = $book->user_id;
            $receipt->booking_class_id = $book->id;
            $receipt->save();
        }
    }
}

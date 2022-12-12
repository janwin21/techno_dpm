<?php

namespace App\Http\Controllers;

use PDF;

class PDFController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /* Visit Card Page Uploader to Preview and Upload PDF */
    public function cards() {
        $data = [
            'counter' => 0
        ];
        
        return view('pdf.pages.yugioh_card_pdf', compact('data'));
    }

    /* PREVIEW & DOWNLOAD PDF from Card Page Uploader */
    public function upload_cards() {
        $data = [
            'counter' => 0
        ];

        $pdf = PDF::loadView('pdf.contents.owned_cards', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->stream('cards_table.pdf');
    }

}

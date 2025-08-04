<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ContractSent extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;

    public function __construct($contract)
    {
        $this->contract = $contract;
    }

    public function build()
    {
        return $this->subject('Student Housing Contract')
            ->markdown('emails.contract.sent')
            ->attach(Storage::disk('public')->path($this->contract->file_path), [
                'as' => 'Housing-Contract.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}

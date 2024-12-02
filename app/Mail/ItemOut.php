<?php

namespace App\Mail;

use App\Models\ItemMovement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ItemOut extends Mailable
{
    use Queueable, SerializesModels;

    public $itemMovement;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ItemMovement $itemMovement)
    {
        $this->itemMovement = $itemMovement;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.item_out')
            ->with([
                'itemMovement' => $this->itemMovement
            ]);
    }
}

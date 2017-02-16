<?php

namespace Laralum\Tickets\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;


class Message extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laralum_tickets_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ticket_id', 'user_id', 'message'];

    /**
     * Get the ticket that owns the message.
     */
    public function ticket()
    {
        return $this->belongsTo('Laralum\Tickets\Models\Ticket');
    }

    /**
     * Return true if message is send from user
     **/
    public function isAdmin()
    {
        return !($this->user_id == $this->ticket->user_id);
    }


    /**
     * Return true if message is send from user
     **/
    public function isCurrentUser()
    {
        return ($this->user_id == Auth::id());
    }

    /**
     * Get the color for the title of this message
     **/
    public function titleColor()
    {
        if ($this->isAdmin()) {
            return '#F44336';
        }

        return '#009688';
    }

    /**
     * Get the color for this message
     **/
    public function color()
    {
        if ($this->isAdmin()) {
            if ($this->isCurrentUser()) {
                return '#EF9A9A';
            }
            return '#FFCDD2';
        }

        return '#B2DFDB';
    }


}
<?php

namespace App\Imports;

use App\Models\BulkSMS;
use Illuminate\Support\Str;
use App\Models\ContactGroup;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class ContactImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $user_id;
    protected $sender_name;
    protected $message;

    public function __construct($user_id, $sender_name, $message)
    {
        $this->user_id = $user_id;
        $this->sender_name = $sender_name;
        $this->message = $message;
    }

    public function array(array $rows)
    {
        $columnData = [];

        foreach ($rows as $row) {
            // Check if the column exists in the current row
            if (isset($row[0])) {
              
                array_push($columnData, $row[0]);
                // $columnData[] = $row[0];
            }
        }

        return $columnData;
    }
    public function model(array $row)
    {

        $contact =  $row[0];
        //here some account number are actually 10 in number
        if (Str::length($contact) == 10) {
            $contact = "0" . $contact;
        } elseif (Str::length($contact) < 10) {
            $contact = "Invalid";
        } else {
            $contact = $contact;
        }
        return new BulkSMS([
            'user_id' => $this->user_id,
            'sender_name' => $this->sender_name,
            'message' => $this->message,
            'contacts'    => $contact,
        ]);
    }
}

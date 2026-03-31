<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactImportService
{
    public function import(?UploadedFile $file): void
    {
        if (! $file) {
            return;
        }

        $rows = array_map('str_getcsv', file($file->getRealPath()));
        foreach (array_slice($rows, 1) as $row) {
            Contact::updateOrCreate(['email' => $row[2] ?? null], [
                'first_name' => $row[0] ?? '',
                'last_name' => $row[1] ?? '',
                'email' => $row[2] ?? '',
                'status' => 'active',
            ]);
        }
    }

    public function export(): StreamedResponse
    {
        return response()->streamDownload(function () {
            echo "first_name,last_name,email,status\n";
            Contact::chunk(1000, function ($contacts): void {
                foreach ($contacts as $contact) {
                    echo implode(',', [$contact->first_name, $contact->last_name, $contact->email, $contact->status]) . "\n";
                }
            });
        }, 'contacts.csv');
    }
}
